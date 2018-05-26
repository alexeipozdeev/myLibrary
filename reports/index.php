<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

<div class="container">
    <div class="col-xs-12">
        <h1>Отчеты</h1>

        <ul>
            <li>
                <a href="top_100/">ТОП 100 авторов</a>
            </li>
            <li>
                <a href="books_author/">Книги автора</a>
            </li>
            <li>
                <a href="books_years/">Книги по годам</a>
            </li>
            <li>
                <a href="avg_books_year/">Среднее количество книг в год по автору</a>
            </li>
        </ul>

        <a href="/reports/">Другие отчеты</a>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>