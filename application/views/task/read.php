
<div class="container">
    <main class="task__main">
        <div class="task__table">
            <table>
                <tr>
                    <th><p>Title</p></th>
                    <th><a href="?order=name&&sort=<?=$sort?>">User</a></th>
                    <th><a href="?order=email&&sort=<?=$sort?>">Email</a></th>
                    <th><p>Description</p></th>
                    <th><a href="?order=status&&sort=<?=$sort?>">Status</a></th>
                    <th><p>Changed</p></th>
                    <?php if($is_admin):?>
                    <th><p>Admin</p></th>
                    <?php endif;?>
                </tr>
                <?php foreach ($tasks as $key => $task): ?>
                <tr>
                    <td><?php echo $task['title']?></td>
                    <td><?php echo $task['name']?></td>
                    <td><?php echo $task['email']?></td>
                    <td><?php echo $task['description']?></td>
                    <td><?php echo $task['status']?></td>
                    <td>
                        <?php
                            echo $task['is_changed'] ? 'Отредактирован' : '';
                        ?>

                    </td>
                    <?php if($is_admin):?>
                        <td><button class="edit__button" onclick='editTask(<?= $task['id']?>)'>edit</button></td>
                    <?php endif;?>
                </tr>
                <?php endforeach;?>
            </table>
            <div class="paginate">
                <?php for($i = 1; $i < $pageCount + 1; $i++):?>
                    <a href="?page=<?= $i?><?=$order?>"><?= $i?></a>
                <?php endfor; ?>
            </div>
        </div>
        <div class="add__task">
            <button class="add__button">Add new task</button>
        </div>
    </main>
    <div class="task__fields">
        <form action="create" method="post">
            <label for="user">User name</label>
            <input type="text" placeholder="User" name="user">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="test@gmail.com">
            <label for="">Title</label>
            <input type="text" name="title" placeholder="Shopping">
            <label for="">Description</label>
            <input type="text" name="description" placeholder="Go to shopping">
            <input type="button" value="Create" name="create" id="add__task">
        </form>
    </div>
    <div class="task__edit">
        <label for="user">User name</label>
        <input type="text" name="edit_user">
        <label for="">Email</label>
        <input type="text" name="edit_email">
        <label for="">Title</label>
        <input type="text" name="edit_title">
        <label for="">Description</label>
        <input type="text" name="edit_description">
        <label for="">Status</label>
        <input type="text" name="edit_status">
        <input type="submit" value="Update" id="update__fields">
    </div>
</div>

<style>
    .task__edit{
        display: none;
    }
    .task__fields{
        display: none;
        grid-gap: 1em;
        border: 1px solid gray;
        position: relative;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        width: auto;
        position: absolute;
    }

    .task__main {
        display: flex;
        width: 700px;
    }

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
</style>