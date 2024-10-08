<div>
  <form action="" method="post">
    <!-- Hidden -->
    <?php
    foreach ($_POST as $key => $value) {
    ?>
      <input type="hidden" name="<?= $key; ?>" value='<?= $value; ?>'>
    <?php
    }
    ?>
    <!-- End Of Hidden -->
    <div class="row">
      <?php
        if (isset($_POST['has_medical_aid'])) {
          ?>
          <div class="col-12">
            <div class="alert alert-success" role="alert"><i class="fa fa-lightbulb me-2"></i>Patient has a registered medical aid plan!</div>
          </div>
          <?php
        }
      ?>
      <div class="col-md-6">
        <label class="dispense-payment-btn btn btn-lg btn-outline-primary">
          <input type="radio" name="payment_method" id="cash" value="cash" class="form-check-input"> Cash
        </label>
      </div>
      <div class="col-md-6">
        <label class="dispense-payment-btn btn btn-lg btn-outline-primary">
          <input type="radio" name="payment_method" id="swipe" value="swipe" class="form-check-input"> Swipe
        </label>
      </div>
      <div class="col-md-6">
        <label class="dispense-payment-btn btn btn-lg btn-outline-primary">
          <input type="radio" name="payment_method" id="med_aid" value="med_aid" class="form-check-input" <?=(isset($_POST['has_medical_aid'])) ? 'checked' : '';?>> Medical Aid
        </label>
      </div>
      <div class="col-md-6">
        <label class="dispense-payment-btn btn btn-lg btn-outline-primary">
          <input type="radio" name="payment_method" id="other" value="other" class="form-check-input"> Other
        </label>
      </div>
    </div>
    <hr class="bg-primary">
    <div class="input-group mt-3 justify-content-end">
      <button type="submit" class="btn btn-primary" name="sale" value="sale">Complete Transaction</button>
    </div>
  </form>
</div>