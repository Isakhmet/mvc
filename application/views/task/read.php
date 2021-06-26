
<div class="container">
    <main>
        <div class="task__table">
            <table>
                <tr>
                    <th>Title</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($tasks as $key => $task): ?>
                <tr>
                    <td><?php echo $task['title']?></td>
                    <td><?php echo $task['name']?></td>
                    <td><?php echo $task['email']?></td>
                    <td><?php echo $task['description']?></td>
                    <td><?php echo $task['status']?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </main>
</div>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>