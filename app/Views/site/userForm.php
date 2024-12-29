<?= $this->extend('layouts/layout') ?>

<?= $this->section('Content') ?>

<!-- Add User Button -->
<div class="container mt-5">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
        Add New User
    </button>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <table class="table" id="usersTable">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php  foreach($users as $user): ?>

            <tr>

            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['phone'] ?></td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id'] ?>">
                    Edit
                </button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $user['id'] ?>)">Delete</button>
              
            </td>
            

            </tr>




        <?php endforeach;?>




    


        </tbody>
    </table>
</div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="userForm" method="POST" action="<?= base_url('users') ?>">
                  <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="userForm">Save User</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this Edit Modal for each user -->
<?php foreach($users as $user): ?>
    <div class="modal fade" id="editModal<?= $user['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm<?= $user['id'] ?>" method="POST" action="<?= base_url('user/update/' . $user['id']) ?>">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" value="<?= $user['phone'] ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="editForm<?= $user['id'] ?>">Update User</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- First include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Add the alert code -->
<?php if (session()->getFlashdata('user-success')) : ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('user-success') ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<!-- Add this JavaScript function before the closing </script> tag -->
<script>
function confirmDelete(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this user?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('user/delete/') ?>/' + userId;
        }
    });
}
</script>

<?= $this->endSection() ?>