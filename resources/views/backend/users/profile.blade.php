@extends('backend.layouts.main', ['title' => __('profile.title')])

@section('body')
    <div class="container">
        <div class="page-inner">
            <h3 class="fw-bold mb-3 fs-3">{{ __('profile.title') }}</h3>

            @if (session('success'))
                <div class="alert alert-success">{{ __('profile.success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('profile.name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('profile.email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>
                                {{ __('profile.new_password') }}
                                <small>({{ __('profile.new_password_hint') }})</small>
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control pr-5">
                                <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted toggle-password"
                                    toggle="#password" style="cursor: pointer;"></i>
                            </div>
                            <small id="passwordHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('profile.confirm_password') }}</label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control pr-5">
                                <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted toggle-password"
                                    toggle="#password_confirmation" style="cursor: pointer;"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">{{ __('profile.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('text-muted');
                    this.classList.add('text-primary');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('text-primary');
                    this.classList.add('text-muted');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });

        const passwordInput = document.getElementById('password');
        const passwordHelp = document.getElementById('passwordHelp');

        passwordInput?.addEventListener('input', () => {
            const val = passwordInput.value;
            let message = '';
            let color = 'text-danger';

            if (val.length >= 8 && /[A-Z]/.test(val) && /\d/.test(val) && /[!@#$%^&*]/.test(val)) {
                message = '{{ __('profile.password_strength.strong') }}';
                color = 'text-success';
            } else if (val.length >= 6) {
                message = '{{ __('profile.password_strength.medium') }}';
                color = 'text-warning';
            } else if (val.length > 0) {
                message = '{{ __('profile.password_strength.weak') }}';
                color = 'text-danger';
            }

            passwordHelp.textContent = message;
            passwordHelp.className = `form-text ${color}`;
        });
    </script>
@endpush
