// Online Course Management System - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initializeComponents();
    
    // Auto-hide alerts after 5 seconds
    autoHideAlerts();
    
    // Form validation
    initializeFormValidation();
    
    // Search functionality
    initializeSearch();
    
    // Progress bars animation
    animateProgressBars();
});

// Initialize all components
function initializeComponents() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

// Auto-hide alerts
function autoHideAlerts() {
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
}

// Form validation
function initializeFormValidation() {
    // Password confirmation validation
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');
    
    if (passwordField && confirmPasswordField) {
        confirmPasswordField.addEventListener('input', function() {
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('Mật khẩu xác nhận không khớp');
            } else {
                confirmPasswordField.setCustomValidity('');
            }
        });
    }
    
    // Email validation
    const emailFields = document.querySelectorAll('input[type="email"]');
    emailFields.forEach(function(field) {
        field.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value) && field.value !== '') {
                field.setCustomValidity('Vui lòng nhập email hợp lệ');
            } else {
                field.setCustomValidity('');
            }
        });
    });
    
    // Form submission with loading state
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
                
                // Re-enable button after 3 seconds to prevent permanent disable
                setTimeout(function() {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = submitBtn.getAttribute('data-original-text') || 'Submit';
                }, 3000);
            }
        });
    });
}

// Search functionality
function initializeSearch() {
    const searchForm = document.querySelector('form[action*="/courses"]');
    if (searchForm) {
        const searchInput = searchForm.querySelector('input[name="search"]');
        const categorySelect = searchForm.querySelector('select[name="category"]');
        
        // Auto-submit on category change
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                searchForm.submit();
            });
        }
        
        // Search suggestions (if needed)
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    // Implement search suggestions here if needed
                }, 300);
            });
        }
    }
}

// Animate progress bars
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                
                setTimeout(function() {
                    progressBar.style.width = width;
                }, 100);
                
                observer.unobserve(progressBar);
            }
        });
    });
    
    progressBars.forEach(function(bar) {
        observer.observe(bar);
    });
}

// Utility functions
function showLoading(element) {
    element.innerHTML = '<div class="spinner"></div>';
}

function hideLoading(element, originalContent) {
    element.innerHTML = originalContent;
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(function() {
        const bsAlert = new bootstrap.Alert(notification);
        bsAlert.close();
    }, 5000);
}

// AJAX helper function
function makeRequest(url, method = 'GET', data = null) {
    return fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: data ? JSON.stringify(data) : null
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    });
}

// Course enrollment function
function enrollCourse(courseId) {
    const enrollBtn = document.querySelector(`[data-course-id="${courseId}"]`);
    if (enrollBtn) {
        const originalText = enrollBtn.innerHTML;
        enrollBtn.disabled = true;
        enrollBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang đăng ký...';
        
        makeRequest(`/student/enroll/${courseId}`, 'POST')
            .then(data => {
                if (data.success) {
                    showNotification('Đăng ký khóa học thành công!', 'success');
                    enrollBtn.innerHTML = '<i class="fas fa-check"></i> Đã đăng ký';
                    enrollBtn.classList.remove('btn-success');
                    enrollBtn.classList.add('btn-secondary');
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                showNotification(error.message, 'danger');
                enrollBtn.disabled = false;
                enrollBtn.innerHTML = originalText;
            });
    }
}

// File upload preview
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Confirm delete action
function confirmDelete(message = 'Bạn có chắc chắn muốn xóa?') {
    return confirm(message);
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('vi-VN');
}

// Smooth scroll to element
function scrollToElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Copy to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showNotification('Đã sao chép vào clipboard!', 'success');
    }).catch(function() {
        showNotification('Không thể sao chép!', 'danger');
    });
}

// Local storage helpers
function saveToLocalStorage(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
    } catch (e) {
        console.error('Cannot save to localStorage:', e);
    }
}

function getFromLocalStorage(key) {
    try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    } catch (e) {
        console.error('Cannot read from localStorage:', e);
        return null;
    }
}

// Theme toggle (if needed)
function toggleTheme() {
    const body = document.body;
    const currentTheme = body.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    body.setAttribute('data-theme', newTheme);
    saveToLocalStorage('theme', newTheme);
}

// Initialize theme
function initializeTheme() {
    const savedTheme = getFromLocalStorage('theme');
    if (savedTheme) {
        document.body.setAttribute('data-theme', savedTheme);
    }
}

// Export functions for global use
window.CourseManager = {
    enrollCourse,
    previewImage,
    confirmDelete,
    formatCurrency,
    formatDate,
    showNotification,
    makeRequest,
    scrollToElement,
    copyToClipboard,
    toggleTheme
};