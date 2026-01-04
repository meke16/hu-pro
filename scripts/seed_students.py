#!/usr/bin/env python3

import argparse
import os
import re
import sys
from dataclasses import dataclass
from pathlib import Path
from typing import Iterable, List, Optional, Sequence, Tuple

import mysql.connector


@dataclass(frozen=True)
class DbConfig:
    host: str
    user: str
    password: str
    database: str
    port: int = 3306


STUDENT_COLUMNS: Tuple[str, ...] = (
    "name",
    "sex",
    "idNumber",
    "department",
    "campus",
    "pcSerialNumber",
    "pcModel",
    "contact",
    "photo",
    "year",
)


def _parse_connect_php(connect_php_path: Path) -> Optional[DbConfig]:
    """Best-effort parser for this repo's connect.php.

    Supports both styles found in this workspace:
    - new mysqli("localhost","root","pass","hu")
    - $servername=...; $username=...; $password=...; $dbname=...;
    """

    try:
        text = connect_php_path.read_text(encoding="utf-8", errors="replace")
    except FileNotFoundError:
        return None

    # Style 1: new mysqli("localhost" , "root" , "pass" ,"hu" );
    m = re.search(
        r"new\s+mysqli\(\s*\"(?P<host>[^\"]+)\"\s*,\s*\"(?P<user>[^\"]+)\"\s*,\s*\"(?P<pw>[^\"]*)\"\s*,\s*\"(?P<db>[^\"]+)\"\s*\)",
        text,
        flags=re.IGNORECASE,
    )
    if m:
        return DbConfig(
            host=m.group("host"),
            user=m.group("user"),
            password=m.group("pw"),
            database=m.group("db"),
        )

    # Style 2: $servername="..."; $username="..."; $password="..."; $dbname="...";
    def _get_var(var_name: str) -> Optional[str]:
        mm = re.search(
            rf"\${re.escape(var_name)}\s*=\s*\"(?P<v>[^\"]*)\"\s*;",
            text,
            flags=re.IGNORECASE,
        )
        return mm.group("v") if mm else None

    host = _get_var("servername")
    user = _get_var("username")
    password = _get_var("password")
    database = _get_var("dbname")

    if host and user is not None and password is not None and database:
        return DbConfig(host=host, user=user, password=password, database=database)

    return None


def load_db_config(repo_root: Path, connect_php_relpath: str) -> DbConfig:
    """Loads DB config from env vars, falling back to connect.php."""

    env_host = os.getenv("HU_DB_HOST")
    env_user = os.getenv("HU_DB_USER")
    env_password = os.getenv("HU_DB_PASSWORD")
    env_db = os.getenv("HU_DB_NAME")
    env_port = os.getenv("HU_DB_PORT")

    if env_host and env_user and env_password is not None and env_db:
        port = int(env_port) if env_port else 3306
        return DbConfig(host=env_host, user=env_user, password=env_password, database=env_db, port=port)

    connect_php_path = (repo_root / connect_php_relpath).resolve()
    cfg = _parse_connect_php(connect_php_path)
    if cfg is None:
        raise SystemExit(
            f"Could not load DB config. Set env vars HU_DB_HOST/HU_DB_USER/HU_DB_PASSWORD/HU_DB_NAME "
            f"or ensure {connect_php_relpath} exists and matches expected format."
        )

    if env_port:
        return DbConfig(
            host=cfg.host,
            user=cfg.user,
            password=cfg.password,
            database=cfg.database,
            port=int(env_port),
        )

    return cfg


def connect_db(cfg: DbConfig):
    return mysql.connector.connect(
        host=cfg.host,
        user=cfg.user,
        password=cfg.password,
        database=cfg.database,
        port=cfg.port,
    )


def insert_students(conn, students: Sequence[Tuple]):
    placeholders = ", ".join(["%s"] * len(STUDENT_COLUMNS))
    cols = ", ".join(STUDENT_COLUMNS)
    sql = f"INSERT INTO students ({cols}) VALUES ({placeholders})"

    with conn.cursor() as cur:
        cur.executemany(sql, students)
    conn.commit()


def execute_sql_file(conn, sql_path: Path):
    sql = sql_path.read_text(encoding="utf-8", errors="replace").strip()

    # Strip a UTF-8 BOM if present
    if sql.startswith("\ufeff"):
        sql = sql.lstrip("\ufeff")

    # Very small safeguard: only allow INSERT statements in this helper
    if not re.match(r"^\s*INSERT\s+INTO\s+students\b", sql, flags=re.IGNORECASE):
        raise SystemExit(
            f"Refusing to execute SQL that does not start with 'INSERT INTO students': {sql_path}"
        )

    with conn.cursor() as cur:
        cur.execute(sql)
    conn.commit()


def main(argv: List[str]) -> int:
    parser = argparse.ArgumentParser(
        description=(
            "Insert student rows into the 'hu' MySQL database. "
            "Defaults to inserting a small list from code; can also execute insert_students_bulk.sql."
        )
    )
    parser.add_argument(
        "--connect",
        default="connect.php",
        help="Path (relative to repo root) to connect.php for DB credentials (default: connect.php)",
    )
    parser.add_argument(
        "--sql",
        default=None,
        help="Path to a .sql file to execute (expects 'INSERT INTO students ...')",
    )

    args = parser.parse_args(argv)

    repo_root = Path(__file__).resolve().parents[1]
    cfg = load_db_config(repo_root=repo_root, connect_php_relpath=args.connect)

    conn = connect_db(cfg)
    try:
        if args.sql:
            sql_path = (repo_root / args.sql).resolve() if not os.path.isabs(args.sql) else Path(args.sql)
            execute_sql_file(conn, sql_path)
            print(f"Inserted rows by executing SQL: {sql_path}")
            return 0

        # Insert from code (edit this list to insert your own data)
        students = [
            (
                "Test Student 1",
                "Male",
                123456,
                "Software Engineering",
                "Main",
                "PC-00001",
                "Model-ABC01",
                "0912345678",
                "",
                1,
            ),
            (
                "Test Student 2",
                "Female",
                234567,
                "Computer Science",
                "Harar",
                "PC-00002",
                "Model-DEF02",
                "0987654321",
                "",
                2,
            ),
        ]

        insert_students(conn, students)
        print(f"Inserted {len(students)} student rows from code")
        return 0
    finally:
        conn.close()


if __name__ == "__main__":
    raise SystemExit(main(sys.argv[1:]))
