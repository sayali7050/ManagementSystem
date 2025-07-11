            </div>
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> Hotel Management System.</strong>
        All rights reserved.
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
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
            <div class="toast toast-${type}" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">${message}</div>
            </div>
        `;
        
        $('body').append(toastHtml);
        $('.toast').toast('show');
        
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