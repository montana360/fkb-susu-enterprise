<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('users.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="row p-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
                                <label class="col-xl-3 col-form-label">{{ _lang('Address') }}</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        required>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                <label class="col-xl-3 col-form-label">{{ _lang('Next of Kin') }}</label>
                                    <input type="text" class="form-control" name="nok" value="{{ old('nok') }}"
                                        required>
                                </div>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-xl-3 col-form-label">{{ _lang('Source of Finance') }}</label>
                                    <input type="text" class="form-control" name="sof" value="{{ old('sof') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-xl-3 col-form-label">{{ _lang('Date of Birth') }}</label>
                                    <input type="text" class="form-control datepicker" name="dob" value="{{ old('dob') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-xl-3 col-form-label">{{ _lang('Gender') }}</label>
                                    <select class="form-control auto-select" data-selected="{{ old('gender') }}"
                                        name="gender" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="Male">{{ _lang('Male') }}</option>
                                        <option value="Female">{{ _lang('Female') }}</option>
                                    </select>
                                </div>
                            </div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Email') }}</label>
				<input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
			</div>
		</div>

		<!-- <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Account Number') }}</label>
				<input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required>
			</div>
		</div> -->

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Password') }}</label>
				<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Country Code') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('country_code') }}" name="country_code" required>
					<option value="">{{ _lang('Select One') }}</option>
					@foreach(get_country_codes() as $key => $value)
						<option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Phone') }}</label>
				<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Branch') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('branch_id') }}" name="branch_id" required>
					<option value="">{{ _lang('Select One') }}</option>
					{{ create_option('branches','id','name') }}
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Product') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('product_id') }}" name="product_id" required>
					<option value="">{{ _lang('Select One') }}</option>
					{{ create_option('products','id','name') }}
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('status') }}" name="status" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="0">{{ _lang('In Active') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Email Verified') }}</label>
				<select class="form-control select2 auto-select" name="email_verified_at">
					<option value="">{{ _lang('No') }}</option>
					<option value="{{ now() }}">{{ _lang('Yes') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('SMS Verified') }}</label>
				<select class="form-control select2 auto-select" name="sms_verified_at">
					<option value="">{{ _lang('No') }}</option>
					<option value="{{ now() }}">{{ _lang('Yes') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Profile Picture') }}</label>
				<input type="file" class="form-control dropify" name="profile_picture" >
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save') }}</button>
			</div>
		</div>
	</div>
</form>