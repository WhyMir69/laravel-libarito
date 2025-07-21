<form wire:submit="login">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input wire:model="remember" type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember Me</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
