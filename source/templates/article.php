<article id="<?= $article->slug ?>" class="<?= $article->slug ?>">
    <h1><?= $article->title ?></h1>

    <div>
        <div>
            <?php
            foreach ($article->sections as $k => $section) {
                if (isset($breaks) && in_array($k, $breaks, true)) {
                    echo '</div><div>';
                }

                $this->insert('section', ['section' => $section]);
            }
            ?>
        </div>
    </div>
</article>
