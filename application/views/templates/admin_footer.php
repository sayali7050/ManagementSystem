            </div>
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                <strong>&copy; <?= date('Y') ?> LuxuryHotel Admin.</strong> All rights reserved.
            </div>
            <div class="text-muted small">
                <b>Version</b> 1.0.0
            </div>
        </div>
    </footer>
</div>

<!-- jQuery (for DataTables and legacy support) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables (Bootstrap 5) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTables
    if ($('.table').length) {
        $('.table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Confirm delete actions
    $('.btn-delete').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this item?')) {
            e.preventDefault();
        }
    });

    // AJAX status updates
    $('.status-toggle').on('change', function() {
        const $this = $(this);
        const url = $this.data('url');
        const status = $this.is(':checked') ? 'active' : 'inactive';
        
        $.post(url, {
            status: status,
            [csrfName]: csrfHash
        })
        .done(function(response) {
            if (response.success) {
                showToast('Status updated successfully', 'success');
            } else {
                showToast('Failed to update status', 'error');
                $this.prop('checked', !$this.prop('checked'));
            }
        })
        .fail(function() {
            showToast('Error updating status', 'error');
            $this.prop('checked', !$this.prop('checked'));
        });
    });

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastHtml = `
            <div class="toast align-items-center text-bg-${type} border-0 show" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        $('body').append(toastHtml);
        setTimeout(function() {
            $('.toast').remove();
        }, 3000);
    }

    // Real-time updates (if needed)
    function updateDashboard() {
        // Add any real-time update logic here
    }

    // Update dashboard every 30 seconds
    setInterval(updateDashboard, 30000);
});
</script>

</body>
</html>