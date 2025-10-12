<?php
session_start();
$current_year = date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Checkup System - Haramaya University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(44, 62, 80, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-pc-display-horizontal me-2"></i>
                <strong>HU PC Checkup</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display">Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">PC Checkup System</h1>
                <p class="hero-subtitle">Haramaya University - Computer Management Solution</p>
                <p class="lead mb-4">Streamlining computer inventory management and maintenance tracking for academic excellence</p>
                
                <div class="cta-buttons">
                    <a href="display" class="btn btn-cta btn-lg">
                        <i class="bi bi-list-check me-2"></i>View All Records
                    </a>
                    <a href="display" class="btn btn-cta btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Add New Record
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions Section -->
    <section class="quick-actions" style="background: black;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-white mb-3">Quick Actions</h2>
                <p class="lead text-white text-muted">Manage your computer inventory efficiently</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="display" class="action-card fade-in-up">
                        <div class="action-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h3 class="action-title">Add New Record</h3>
                        <p class="action-description">
                            Register new computer assignments for students with detailed specifications and contact information.
                        </p>
                    </a>
                </div>
                
                <div class="col-md-4">
                    <a href="display" class="action-card fade-in-up">
                        <div class="action-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3 class="action-title">Search Records</h3>
                        <p class="action-description">
                            Quickly find student records by name, ID number, or computer serial number with advanced search.
                        </p>
                    </a>
                </div>
                
                <div class="col-md-4">
                    <a href="display" class="action-card fade-in-up">
                        <div class="action-icon">
                            <i class="bi bi-printer"></i>
                        </div>
                        <h3 class="action-title">Generate Reports</h3>
                        <p class="action-description">
                            Print comprehensive reports of computer assignments for administrative and archival purposes.
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number" id="studentsCount">2000+</div>
                        <div class="stat-label">Students Served</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number" id="computersCount">1250+</div>
                        <div class="stat-label">Computers Managed</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number" id="departmentsCount">45+</div>
                        <div class="stat-label">Departments</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number" id="yearsCount"><?php echo $current_year; ?></div>
                        <div class="stat-label">Current Year</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section style="padding: 80px 0; background:black;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-white mb-3">System Features</h2>
                <p class="lead text-white">Comprehensive computer management solution</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-database-check"></i>
                        </div>
                        <h4>Secure Database</h4>
                        <p>All records stored securely with backup and recovery systems</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-search-heart"></i>
                        </div>
                        <h4>Advanced Search</h4>
                        <p>Quickly find any record with intelligent search functionality(multiple search at same time to save time)</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                        <h4>Report Generation</h4>
                        <p>Generate and print comprehensive reports in various formats</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Data Security</h4>
                        <p>Enterprise-level security to protect sensitive information</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3 class="text-gradient">Haramaya University</h3>
                    <p>Excellence in Education, Research, and Community Service</p>
                    <p><small>PC Checkup Management System</small></p>
                </div>
                
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="home"><i class="bi bi-house-fill"></i> Home</a></li>
                        <li><a href="display"><i class="bi bi-list-check"></i> Records</a></li>
                        <li><a href="#"><i class="bi bi-info-circle"></i> About</a></li>
                        <li><a href="#"><i class="bi bi-headset"></i> Support</a></li>
                    </ul>
                </div>
                
                <div class="footer-contact">
                    <h4>Contact Info</h4>
                    <p><i class="bi bi-geo-alt-fill"></i> Harar, Ethiopia</p>
                    <p><i class="bi bi-telephone-fill"></i> +251 (0)25 553 0333</p>
                    <p><i class="bi bi-envelope-fill"></i> info@haramaya.edu.et</p>
                    <p><i class="bi bi-globe"></i> www.haramaya.edu.et</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Haramaya University - PC Checkup System. All rights reserved.</p>
                <p class="mt-1">Developed with <i class="bi bi-heart-fill text-danger"></i> for Academic Excellence</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll animations
        function checkScroll() {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        }

        // Counter animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start) + '+';
                }
            }, 16);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Check scroll position on load
            checkScroll();
            
            // Add scroll event listener
            window.addEventListener('scroll', checkScroll);
            
            // Animate counters when they come into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const finalValue = parseInt(target.getAttribute('data-target'));
                        animateCounter(target, finalValue);
                        observer.unobserve(target);
                    }
                });
            }, { threshold: 0.5 });

            // Observe counter elements
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const currentText = counter.textContent;
                const targetValue = parseInt(currentText);
                counter.setAttribute('data-target', targetValue);
                counter.textContent = '0';
                observer.observe(counter);
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(44, 62, 80, 0.98)';
            } else {
                navbar.style.background = 'rgba(44, 62, 80, 0.95)';
            }
        });
    </script>
</body>
</html>