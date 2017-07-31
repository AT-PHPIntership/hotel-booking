<!-- search form -->
<section id="reservation-form">
  <div class="container">
    <div class="row">
      <div class="col-md-12">           
        <form class="reservation-horizontal clearfix container-search" action="/search" name="reservationform" >
        <div id="message"></div><!-- Error message display -->
          <div class="row">
           
            <div class="coltest">
              <div class="form-group">
                <label for="room">Place</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <select class="form-control" name="room" id="room">
                  <option selected="selected" disabled="disabled">Select a room</option>
                  <option value="Single">hhhhh</option>
                  <option value="Double">Double Room</option>
                  <option value="Deluxe">Deluxe room</option>
                </select>
              </div>
            </div>
            <div class="coltest">
              <div class="form-group">
                <label for="checkin">Check-in</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
              </div>
            </div>
            <div class="coltest">
              <div class="form-group">
                <label for="checkout">Check-out</label>
                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                
                <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
              </div>
            </div>
            <div class="btnSubmit">
              <button type="submit" class="btn btn-primary btn-block">Book Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>