<?php
include_once(VIEWS_PATH.'login.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form method="POST">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Title</th>
              <th style="width: 30%;">Runtime (mins)</th>
              <th style="width: 20%;">Rating</th>
              <th> </th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              foreach($lista as $movie)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $movie->getTitle() ?></td>
                    <td class="border"><?php echo $movie->getRuntime() ?></td>
                    <td class="border"><?php echo $movie->getPoints() ?></td>
                    <td class="border">
                      <input type="checkbox">
                    </td>
                  </tr>
                <?php

              }
            ?>                          
          </tbody>
        </table></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
