
    // Delete confirmation
    function confirmDelete(id) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        var deleteBtn = document.getElementById('confirmDeleteBtn');
        
        deleteBtn.href = 'display.php?deleteid=' + id;
        deleteModal.show();
    }
    // View student profile
    function viewProfile(id) {
        $.get('display.php', {
            get_student: 1,
            id: id
        }, function(data) {
            try {
                var student = JSON.parse(data);
                if (student.error) {
                    alert(student.error);
                    return;
                }
                
                var photo = student.photo || 'assets/default-profile.jpg';
                
                var profileHtml = `
                    <div class="profile-header text-center">
                        <img src="${photo}" class="profile-img mb-2" alt="Student Photo">
                        <h3>${student.name}</h3>
                    </div>
                    <div class="profile-details">
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Gender:</div>
                            <div class="col-md-8">${student.sex}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">ID Number:</div>
                            <div class="col-md-8">${student.idNumber}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Department:</div>
                            <div class="col-md-8">${student.department}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Batch:</div>
                            <div class="col-md-8">${student.year}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Campus:</div>
                            <div class="col-md-8">${student.campus}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">PC Serial Number:</div>
                            <div class="col-md-8">${student.pcSerialNumber}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">PC Model:</div>
                            <div class="col-md-8">${student.pcModel || 'Not specified'}</div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Contact:</div>
                            <div class="col-md-8">${student.contact || 'Not provided'}</div>
                        </div>
                    </div>
                `;
                
                $('#profileContent').html(profileHtml);
                $('#profileOverlay').show();
            } catch (e) {
                console.error('Error parsing student data:', e);
                alert('Error loading student profile');
            }
        }).fail(function() {
            alert('Failed to load student profile');
        });
    }

    // Close profile view
    function closeProfile() {
        $('#profileOverlay').hide();
    }

    // Form validation
    (function() {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
