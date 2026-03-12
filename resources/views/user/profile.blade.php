@extends('layouts.user')

@section('content')
<div class="mb-10 block">
    <h1 class="text-3xl font-bold font-serif leading-tight">Profile Settings</h1>
    <p class="text-gray-400 font-medium italic mt-1">Manage your account information</p>
</div>

<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden max-w-2xl">
    <div class="p-6">
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border-gray-200 focus:border-[#004743] focus:ring-[#004743] rounded-xl px-4 py-3" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 border-gray-200 focus:border-[#004743] focus:ring-[#004743] rounded-xl px-4 py-3" required autocomplete="username" />
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <hr class="border-gray-100 my-8">
                
                <div>
                    <h3 class="font-bold font-serif text-lg leading-tight mb-1">Change Password</h3>
                    <p class="text-sm text-gray-400 mb-6">Leave blank if you don't want to change your password</p>
                </div>

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="w-full bg-gray-50 border-gray-200 focus:border-[#004743] focus:ring-[#004743] rounded-xl px-4 py-3" autocomplete="current-password" />
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">New Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-gray-50 border-gray-200 focus:border-[#004743] focus:ring-[#004743] rounded-xl px-4 py-3" autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-50 border-gray-200 focus:border-[#004743] focus:ring-[#004743] rounded-xl px-4 py-3" autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-8 flex items-center justify-end">
                <button type="submit" class="px-6 py-3 bg-[#004743] hover:brightness-110 text-white font-bold rounded-xl transition shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
