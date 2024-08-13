<?php
    $flashMsg = '';
    $errFlashMsg = '';

    $date = date('Y-m-d H:i:s');

    if( $_POST ){
        $title = htmlentities(trim($_POST['title']));
        $content = htmlentities(trim($_POST['content']));

        $source = [
            'title' => $title,
            'content' => $content,
            'title_en' => $title,
            'content_en' => $content,
            'created_at' => $date,
            'updated_at' => $date,
        ];

        if( !$title || !$content ){
            $errFlashMsg = 'Ошибка! Заполните все обязательные поля!';
        }

        $allowed = array("title","content", "title_en", "content_en", "created_at", "updated_at"); // allowed fields
        $sql = "INSERT INTO books SET ".pdoSet($allowed,$values, $source);
        $stm = $db->prepare($sql);

        try{
            $stm->execute($values);
            header("Location: /books/add");
            exit();
        }
        catch(e){
            var_dump(e);
            $errFlashMsg = 'Ошибка сохранения!';
        }
    }
?>

<section>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Все книги</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавление новой книги</li>
            </ol>
        </nav>

        <h3 class="text-center">Добавление новой книги</h3>

        <?php if( $flashMsg ):?>
            <div class="alert alert-success" role="alert">
                Новая книга успешно добавлена
            </div>
        <?php endif;?>
        <?php if( $errFlashMsg ):?>
            <div class="alert alert-danger" role="alert">
                <?= $errFlashMsg ?>
            </div>
        <?php endif;?>

        <form class="row g-3 needs-validation add_form" action="" method="POST">

            <div class="mb-1">
                <label for="bookTitle" class="form-label">Название книги</label>
                <input type="text" class="form-control" id="bookTitle" name="title" required>
                <div class="invalid-feedback">
                    Введите название книги
                </div>
            </div>

            <div class="mb-3">
                <label for="bookContent" class="form-label">Оглавление книги</label>
                <textarea class="form-control" id="bookContent" rows="3" name="content" required></textarea>
                <div class="invalid-feedback">
                    Введите оглавление книги
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Добавить</button>
            </div>

        </form>
    </div>
</section>