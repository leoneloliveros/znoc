<div id="export-excel"><i class="far fa-file-excel"></i></div>
<div class="table-new">
    <?php
        $this->datatables->generate('bitacora_BO_table');
        $this->datatables->jquery('bitacora_BO_table');
    ?>
</div>

<!-- </div> -->


<style>
    #container-graph {
        width: 100%;
    }
    .table-new {
        width: 95%;
        background-color: #FFFFFF;
        box-shadow: 0 29px 32px -20px rgba(0,0,0,0.5), 0 4px 11px -3px rgba(0,0,0,0.25);
        padding: 20px;
        border-radius: 10px;
        margin-top: -50px;
        position: relative;
        z-index: 4;
        transition: all 0.3s ease;
        margin: 30px 40px;
        height: 100%;
        margin-top: 10px;
        white-space: nowrap;
        text-align: center;
}
</style>
