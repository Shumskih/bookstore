<aside class="wedget__categories poroduct--cat">
  <h3 class="wedget__title">Product Categories</h3>
  <ul>
      <?php foreach ($var as $k => $v): ?>
          <?php if (isset($v['categories'])): ?>
              <?php foreach ($v['categories'] as $c): ?>
                  <?php $category = (object)$c; ?>

            <li>
              <a href="/category?id=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?>
                <span>(<?php echo $category->getCountBooks(); ?>)</span></a>
            </li>
                  <?php unset($category); ?>
              <?php endforeach; ?>
          <?php endif; ?>
      <?php endforeach; ?>
  </ul>
</aside>