<div class="modal" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive-sm">
        <table class="show-cart table">
          <tr>
            <p id="para"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>LOADING................</p>
          </tr>
          
        </table>
        <div class="tp">Total price in BDT: <span class="total-cart"></span> TK</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="complete-order" class="btn btn-primary">Checkout</button>
      </div>
    </div>
  </div>
</div>