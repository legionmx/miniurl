<div class="col-md-4 col-sm-6">
        <ul>
                <li>&nbsp;</li>
                <li>Number of links: <span id=totalLinks><?php echo $totalNumOfUserLinks;?></span></li>
        </ul>
</div>
<div class="col-md-5 col-md-offset-3 col-sm-6">
        <ul class="pagination">
                <li class="disabled">
                        <a id="pager_prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                        </a>
                </li>
                <?php
                //for($i = 0, $j = 1;$i<$lastInitialRecord && $i<$numberOfVisitedLinks;$i+=$limit,$j++){
                //for($i = 0, $j = 1;$i<$numberOfVisitedLinks;$i+=$limit,$j++){
                for($i = 0, $j = 1;$i<$totalNumOfUserLinks;$i+=$limit,$j++){
                        ?>
                        <li<?php echo " id='page-$j'"; if($i>=$lastInitialRecord) echo ' class="hidden"'; ?>><a class="page-selector" offset="<?php echo $i;?>"><?php echo $j; ?></a></li>
                        <?php
                }
                ?>
                <li>
                        <a id="pager_next" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                        </a>
                </li>
        </ul>
</div>