<aside id="bootnews_custompost-10" class="widget widget_categories widget_categories_custom">
    <div class="block-title-4">
        <h4 class="h5 title-arrow"><span><i class="fab fa-megaport"></i> Informasi dan Berita</span></h4>
    </div>
    <!--style 3-->
    <div id="timeline-post">
        <ul class="timeline-post">
            <?php foreach ($v_beritaa as $beritaa) : ?>
                <li>
                    <a href="<?= base_url(); ?>/content/<?= $beritaa['slug_artikel']; ?>">
                        <span class="timeline-date small">
                            <time class="news-date">
                                <?php
                                $date = $beritaa['created_date'];
                                echo date('d M Y', strtotime($date));
                                ?>
                            </time>
                        </span>
                        <h4 class="h6 timeline-title"><?= $beritaa['judul']; ?></h4>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php foreach ($v_informasii as $informasii) : ?>
                <li>
                    <a href="<?= base_url(); ?>/content/<?= $informasii['slug_artikel']; ?>">
                        <span class="timeline-date small">
                            <time class="news-date">
                                <?php
                                $date = $informasii['created_date'];
                                echo date('d M Y', strtotime($date));
                                ?>
                            </time>
                        </span>
                        <h4 class="h6 timeline-title"><?= $informasii['judul']; ?></h4>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="gap-05"></div>
    </div>
</aside>