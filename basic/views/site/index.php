<?php

/** @var yii\web\View $this */

$this->title = 'Test Yii Application';
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <?php foreach($categories as $category) { ?>
                        <li><a class="js-list" href="#" data-id="<?= $category->id; ?>"><?= $category->title; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row" id="content">
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.js-list');
        for (const link of links) {
            link.addEventListener('click', e => {
                e.preventDefault();
                const contentElement = document.getElementById('content');
                axios
                    .get('/item-by-category/' + e.currentTarget.dataset.id)
                    .then(response => {
                        let html = '';
                        if (response.data.length) {
                            for (const item of response.data) {
                                html += `
                                <div class="col-md-3">
                                    <div class="card">
                                      <div class="card-body">
                                        <h5 class="card-title">${item.title}</h5>
                                        <p class="card-text">${item.description}</p>
                                      </div>
                                    </div>
                                </div>
                                `;
                            }
                        } else {
                            html = `
                                    <div class="alert alert-danger" role="alert">
                                      Ничего нет в этой категории
                                    </div>
                                `;
                        }
                        document.getElementById('content').innerHTML = html;
                    })
                    .catch(e => {});
            })
        }
    });
</script>
