<?php
    $books = $db->query('SELECT * FROM books ORDER BY created_at DESC');

    $title = '';
    $sort = '';

    $order = 'ORDER BY created_at DESC';
    $condition = '';

    $allow_sort_values = ['desc_date', 'asc_date', 'asc_title', 'desc_title'];

    if( $_POST ){
        if( isset($_POST['q']) && mb_strlen($_POST['q']) > 0 ){
            $title = htmlentities(trim($_POST['q']));
            $condition = "WHERE title LIKE '%{$title}%' OR content LIKE '%{$title}%'";
        }
        if( isset($_POST['sort']) && in_array($_POST['sort'], $allow_sort_values) ){
            $sort = $_POST['sort'];
            if( $sort == 'asc_date' ){
                $order = "ORDER BY created_at";
            } elseif( $sort == 'asc_title' ){
                $order = "ORDER BY title";
            } elseif( $sort == 'desc_title' ){
                $order = "ORDER BY title DESC";
            }
        }

        $books = $db->query('SELECT * FROM books ' . $condition .' ' . $order);
    }

    $books = $books->fetchAll();
?>

<section>
    <div class="container">
        <div class="heading_block">
            <h4 class="text-center">All Books in Library</h4>
            <a href="/books/add" class="btn btn-success">Добавить книгу</a>
        </div>

        <form class="row g-3 find_form" action="/" method="POST">
            <div class="mb-1 col-sm-7">
                <input type="text" class="form-control" id="bookTitle" name="q" placeholder="Поиск" value="<?= ($title) ? $title : '' ?>" >
            </div>
            <div class="col-auto">
                <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                <select class="form-select" name="sort" id="autoSizingSelect">
                    <option selected value="">Сортировка</option>
                    <option value="desc_date" <?= ($sort == 'desc_date') ? 'selected' : '' ?> >Сначала новые</option>
                    <option value="asc_date" <?= ($sort == 'asc_date') ? 'selected' : '' ?> >Сначала старые</option>
                    <option value="asc_title" <?= ($sort == 'asc_title') ? 'selected' : '' ?> >А-Я</option>
                    <option value="desc_title" <?= ($sort == 'desc_title') ? 'selected' : '' ?> >Я-А</option>
                </select>
            </div>
            <div class="col-sm">
                <button class="btn btn-primary" type="submit">Поиск</button>
                <a class="btn btn-danger" href="/">Сброс</a>
            </div>
        </form>

        

        <div class="row row-cols-4 books_list">
            <?php foreach( $books as $item ): ?>
                <div class="card col">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['title'] ?></h5>
                        <p class="card-text"><?= $item['content'] ?></p>
                        <a href="javascript:;" class="btn btn-primary">Читать</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</section>