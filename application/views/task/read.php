
<div class="container">
    <main class="task__main">
        <div class="task__table">
            <table>
                <tr>
                    <th><p>Задачи</p></th>
                    <th><a href="?page=<?= $page?>&&order=name&&sort=<?=$sort?>">Пользователь</a></th>
                    <th><a href="?page=<?= $page?>&&order=email&&sort=<?=$sort?>">Почта</a></th>
                    <th><p>Описание задачи</p></th>
                    <th><a href="?page=<?= $page?>&&order=status&&sort=<?=$sort?>">Статус</a></th>
                    <th><p>Изменен админом</p></th>
                    <?php if($is_admin):?>
                    <th><p>Редактирование</p></th>
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
                            echo $task['is_changed'] ? 'отредактировано администратором' : '';
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
            <button class="add__button">+</button>
        </div>


        <div class="task_modal-create" aria-hidden="true">
            <div class="wrap_modal">
                <div class="task_title">
                    <h2>Создать новую задачу</h2>
                    <a href="#" class="task_close closemodal" aria-hidden="true">×</a>
                </div>
                <div class="task_fields">
                    <input type="text" name="user" placeholder="Пользователь">
                    <input type="text" name="email" placeholder="Почта">
                    <input type="text" name="title" placeholder="Задача">
                    <input type="text" name="description" placeholder="Описание задачи">
                </div>
                <div class="task_create">
                    <a href="" id="add__task" class="create_button">Создать</a>
                </div>
            </div>
        </div>
        <div class="task_modal-update" aria-hidden="true">
            <div class="wrap_modal">
                <div class="task_title">
                    <h2>Редактировать задачу</h2>
                    <a href="#" class="task_close closemodal" aria-hidden="true">×</a>
                </div>
                <div class="task_fields">
                    <input type="text" name="edit_user" placeholder="Пользователь">
                    <input type="text" name="edit_email" placeholder="Почта">
                    <input type="text" name="edit_title" placeholder="Задача">
                    <input type="text" name="edit_description" placeholder="Описание задачи">
                    <div class="status_done">
                        <label for="status">Выполнено</label>
                        <input type="checkbox" name="edit_status" id="status">
                    </div>
                </div>
                <div class="task_create">
                    <a href="" id="update__fields" class="update_button">Сохранить изменения</a>
                </div>
            </div>
        </div>
        <div class="signin_modal" aria-hidden="true">
            <div class="wrap_modal">
                <div class="task_title">
                    <h2>Войдите в свой аккаунт</h2>
                    <a href="#" class="task_close closemodal" aria-hidden="true">×</a>
                </div>
                <div class="task_fields">
                    <input type="text" id="username" name="username" placeholder="Пользователь">
                    <input type="password" id="password" name="password" placeholder="Пароль">
                </div>
                <div class="task_create">
                    <a href="" id="login" class="update_button">Авторизоваться</a>
                </div>
            </div>
        </div>
    </main>
</div>