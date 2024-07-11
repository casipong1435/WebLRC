<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Change Password') }}</div>
    
                    <div class="card-body">
                        <form wire:submit.prevent="changePassword">
                            @csrf

                            <div class="row mb-3">
                                <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>
    
                                <div class="col-md-6">
                                    <div class="input-group flex-nowrap">
                                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" wire:model="new_password" required autocomplete="current-new_password" aria-describedby="addon-wrapping">
                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key-fill"></i></span>
                                    </div>
                                    
    
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirm_password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <div class="input-group flex-nowrap">
                                        <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" wire:model="confirm_password" required autocomplete="current-confirm_password" aria-describedby="addon-wrapping">
                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key-fill"></i></span>
                                    </div>
                                    
    
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <input type="checkbox" class="me-2" id="show-password">
                                    <label for="show-password">Show Password</label>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.toaster')

    <script>
        window.addEventListener('change_clicked', function(){
                const toastLiveExample = document.getElementById('liveToast')

                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
        });

        $('#show-password').on('change', function(){
            if($('#show-password').is(':checked')){
                $('#new_password').attr('type', 'text');
                $('#confirm_password').attr('type', 'text');
            }else{
                $('#new_password').attr('type', 'password');
                $('#confirm_password').attr('type', 'password');
            }
        })
        
    </script>
</div>
