<div>
  <form action="">
    <div class="form-group my-3 row">
      <div class="col-6">
        <label for="firstname">Firstname <sup class="text-primary">*</sup></label>
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname">
      </div>
      <div class="col-6">
        <label for="surname">Surname <sup class="text-primary">*</sup></label>
        <input type="text" name="surname" id="surname" class="form-control" placeholder="Enter Surname">
      </div>
    </div>
    <div class="form-group mb-3">
      <label for="nat_id_number">National ID Number <sup class="text-primary">*</sup></label>
      <input type="text" name="nat_id_number" id="nat_id_number" class="form-control" placeholder="63-xxxxxx-R87">
    </div>
    <div class="form-group mb-3">
      <label for="phone_number">Phone Number <sup class="text-primary">*</sup></label>
      <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="071111111">
    </div>
    <div class="form-group mb-3">
      <label for="email">Email <sup class="text-primary">*</sup></label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
    </div>
    <hr class="bg-primary">
    <div class="input-group justify-content-end">
      <!-- Hidden -->
      <input type="hidden" name="register-user" value="register-user">
      <input type="hidden" name="presc_id" value="00000" id="presc_id">
      <!-- End Of Hidden -->
      <button type="button" class="btn btn-primary" data-load="dispense-tab-2">Complete Registration</button>
    </div>
  </form>
</div>