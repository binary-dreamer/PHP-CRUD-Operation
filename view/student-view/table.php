<?php
require_once './view/layout/header.php';
require_once './view/layout/pagination.php';
?>
<br><br>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr><a href="index.php?action=create"><button class="btn btn-primary" name="add">Add</button></a></tr>
            <div class="pagination-container" style="margin-left: 80%;">
            <?php echo $pageSelector; ?>
            </div>
            <tr>
                <th scope="col">Srno.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Calculate the starting serial number based on the current page
            $srno = ($currentPage - 1) * $perPage + 1;

            // Check if there are students to display
            if (mysqli_num_rows($students) > 0):
                while ($user = mysqli_fetch_assoc($students)):
            ?>
                    <tr>
                        <td><?php echo $srno++; ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['gender']); ?></td>
                        <td>
                            <?php if (!empty($user['photo'])): ?>
                                <img src="assets/images/<?php echo htmlspecialchars($user['photo']); ?>" alt="Photo" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?action=update&id=<?php echo htmlspecialchars($user['id']); ?>">Edit</a> |
                            <a href="index.php?action=delete&id=<?php echo htmlspecialchars($user['id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Display Pagination Links -->
    <div class="pagination-container">
    <?php echo $pagination; ?>
</div>

</div>
