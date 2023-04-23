<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Tag') }}: {{ $tag->name }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update Tag') }}
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update the tag name (slug is automatically generated).") }}
              </p>
            </header>

            <form method="POST" action="{{ route('tags.update', $tag->slug) }}" class="mt-6 space-y-6">
              @csrf
              @method('PUT')

              <div>
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $tag->name)" required autofocus autocomplete="name"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
              </div>

              <div class="opacity-70">
                <x-input-label for="slug" :value="__('Slug')"/>
                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full bg-gray-100" :value="old('slug', $tag->slug)" disabled/>
                <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
              </div>

              <div class="opacity-70">
                <x-input-label for="created_at" :value="__('Created Date')"/>
                <x-text-input id="created_at" name="created_at" type="text" class="mt-1 block w-full bg-gray-100" :value="old('created_at', $tag->created_at)" disabled/>
                <x-input-error class="mt-2" :messages="$errors->get('created_at')"/>
              </div>

              <div class="opacity-70">
                <x-input-label for="updated_at" :value="__('Updated Date')"/>
                <x-text-input id="updated_at" name="updated_at" type="text" class="mt-1 block w-full bg-gray-100" :value="old('updated_at', $tag->updated_at)" disabled/>
                <x-input-error class="mt-2" :messages="$errors->get('created_at')"/>
              </div>

              <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Update') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                  <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                    {{ __('Updated!') }}
                  </p>
                @endif
              </div>
            </form>
          </section>
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">
                  Plugin Name
                </th>
                <th class="px-4 py-3">
                  Status
                </th>
                <th class="px-4 py-3">
                  Created Date
                </th>
                <th class="px-4 py-3">
                  Update Date
                </th>
              </tr>
            </thead>

          </table>
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          <section class="space-y-6">
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Delete Tag') }}
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Deleting this plugin cannot be undone!') }}
              </p>
            </header>

            <div class="flex justify-between">
              <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-tag-deletion')">
                {{ __('Delete Tag') }}
              </x-danger-button>

              <a href="{{ route('tags') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                Cancel
              </a>
            </div>

            <x-modal name="confirm-tag-deletion" focusable>
              <form method="POST" action="{{ route('tags.destroy', $tag->slug) }}" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Are you sure you want to delete this tag?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                  {{ __('Once this tag is deleted, it cannot be undone, all plugin links will be permanently deleted.') }}
                </p>

                <div class="mt-6 flex justify-end">
                  <x-secondary-button class="ml-3" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                  </x-secondary-button>

                  <x-danger-button class="ml-3">
                    {{ __('Delete Tag') }}
                  </x-danger-button>
                </div>
              </form>
            </x-modal>
          </section>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
