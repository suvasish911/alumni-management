<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl w-full bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Join Our Alumni Network</h2>
            <p class="text-sm text-gray-500 mt-2">Provide your credentials to register. Your account will remain pending until verified by administration.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                    <input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2.5" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2.5" type="email" name="email" :value="old('email')" required placeholder="johndoe@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
            </div>

            <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 block mb-4">Academic Credentials</span>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID</label>
                        <input id="student_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2" type="text" name="student_id" :value="old('student_id')" required placeholder="e.g. 180101" />
                        <x-input-error :messages="$errors->get('student_id')" class="mt-1" />
                    </div>

                    <div>
                        <label for="batch" class="block text-sm font-medium text-gray-700">Batch</label>
                        <input id="batch" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2" type="text" name="batch" :value="old('batch')" required placeholder="e.g. 45th" />
                        <x-input-error :messages="$errors->get('batch')" class="mt-1" />
                    </div>

                    <div>
                        <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                        <input id="session" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2" type="text" name="session" :value="old('session')" required placeholder="e.g. 2018-19" />
                        <x-input-error :messages="$errors->get('session')" class="mt-1" />
                    </div>
                </div>
            </div>

            <div>
                <label for="profile_image" class="block text-sm font-semibold text-gray-700">Profile Picture</label>
                <div class="mt-1 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg px-6 py-4 bg-gray-50 hover:bg-gray-100 transition duration-150 relative">
                    <div class="space-y-1 text-center pointer-events-none">
                        <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-600">
                            <span class="text-indigo-600 font-medium">Click to upload image</span>
                        </div>
                        <p class="text-xs text-gray-400">PNG, JPG, JPEG up to 2MB</p>
                    </div>
                    <input id="profile_image" type="file" name="profile_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                </div>
                <x-input-error :messages="$errors->get('profile_image')" class="mt-1" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2.5" type="password" name="password" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm p-2.5" type="password" name="password_confirmation" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-100">
                <a class="underline text-sm text-gray-500 hover:text-gray-900 transition duration-150" href="{{ route('login') }}">
                    Already registered?
                </a>

                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-md tracking-wide transition duration-150">
                    Submit Registration
                </button>
            </div>
        </form>
    </div>

</body>
</html>