<aside class="wedget__categories poroduct--cat">
    <h3 class="wedget__title">Product Categories</h3>
    <ul>
        <?php foreach ($var['categories'] as $category): ?>
            <?php $category = (object)$category; ?>

            <li>
                <a href="/category?id=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?>
                    <span>(<?php echo $category->getCountBooks(); ?>)</span></a>
            </li>
            <?php unset($category); ?>
        <?php endforeach; ?>
    </ul>
</aside>