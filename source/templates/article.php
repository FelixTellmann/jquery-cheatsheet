<article id="<?= $slug ?>" class="<?= $slug ?>">
    <h1><?= $title ?></h1>

    <div>
        <div>
            <?php
            foreach ($sections as $k => $section) {
                if (isset($breaks) && in_array($k, $breaks, true)) {
                    echo '</div><div>';
                }

                $this->insert('section', $section);
            }
            ?>
        </div>
    </div>
</article>
