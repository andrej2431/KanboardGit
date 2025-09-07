<details class="accordion-section">
    <summary class="accordion-title"><?= t('Commits') ?></summary>

    <div class="accordion-content">
        <?php foreach ($commits as $c) {  ?>
        <article class="markdown">
            <a href="<?=$c['link']?>" target="_blank"><?=htmlspecialchars($c['message'])?> (<?=htmlspecialchars($c['author'])?>)</a>
        </article>
        
    <?php
    }  
    ?>
    </div>
</details>