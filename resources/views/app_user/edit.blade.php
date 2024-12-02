<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('appUser.update', ['appUser' => $appUser]) }}">
                @csrf
                @method('PATCH')

                <!-- Username -->
                <div class="mt-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username') == null ? $appUser->username : old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
        
                <!-- Pronouns -->
                <div class="mt-4">
                    <x-input-label for="pronouns" :value="__('Pronouns')" />
        
                    <x-select name="pronouns" id="pronouns" class="block mt-1 w-full" :value="$appUser->pronouns" autofocus>
                        <option value="he/him">He/Him</option>
                        <option value="she/her">She/Her</option>
                        <option value="they/them">They/Them</option>
                        <option value="withheld">Prefer not to say</option>
                    </x-select>
        
                    <x-input-error :messages="$errors->get('pronouns')" class="mt-2" />
                </div>
        
                <!-- Level -->
        
                <div class="mt-4">
                    <x-input-label for="level" :value="__('Level')"/>
                    <x-select name="level" id="level" class="block mt-1 w-full" :value="$appUser->level" autofocus>
                        <option value="gamer">Gamer</option>
                        <option value="student">Student</option>
                        <option value="trainee">Trainee</option>
                        <option value="junior">Junior</option>
                        <option value="developer">Developer</option>
                        <option value="senior">Senior</option>
                        <option value="leader">Leader</option>
                    </x-select>
        
                    <x-input-error :messages="$errors->get('level')" class="mt-2" />
                </div>

                <!-- Status -->

                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="$appUser->status" autofocus/>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
        
               <!-- About -->

               <div class="mt-4">
                <x-input-label for="about" :value="__('About')" />
                <x-text-area id="about" class="block mt-1 w-full" name="about" autofocus>
                    {{$appUser->about}}
                </x-text-area>
                <x-input-error :messages="$errors->get('about')" class="mt-2" />
            </div>


                <div class="flex items-center justify-center mt-4">
                    <!-- Submit -->
                    <x-primary-button class="ms-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
            <form method="POST" action="{{route('appUser.destroy', ['appUser' => $appUser])}}" >
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-center mt-4">
                    <x-danger-button class="ms-4">
                        delete profile
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
