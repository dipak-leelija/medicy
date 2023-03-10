<div class="card border-left-danger h-100 py-2 animated--grow-in">
    <div class="card-body pb-0">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Expiring in 3 Months </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php 
                        $thisMonth = date("m/y");
                        $newMnth = date("m/y", strtotime("+2 months"));
                        echo count($CurrentStock->showStockExpiry($newMnth)); 
                    ?> Stocks</div>
            </div>
            <div class="col-auto text-danger">
                <i class="fas fa-calendar-times"></i>
            </div>
        </div>
    </div>
</div>