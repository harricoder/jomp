<x-app-layout>

  <x-slot name="header">
    <div class="w-25">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-3">
        {{ __('Tags') }}
      </h2>
    </div>

    <div class="w-50">
      <form action="{{ route('tags.store') }}" method="POST" min-width="400 500 600 700">
        <div class="flex items-end">
          <div class="flex items-center w-full max-w-md mb-1">
            <div class="relative mr-3">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                </svg>
              </div>
              <input type="text" name="name" id="name" class="block px-2.5 pb-2.5 pt-4 pl-10 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
              <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                Tag Name
              </label>
            </div>
            <button type="submit">
              <span class="px-5 py-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add
              </span>
            </button>
          </div>
        </div>
        @error('name')
        <p class="mt-1 text-sm text-red-600 dark:text-red-500">
          {{ $message }}
        </p>
        @enderror
        @csrf
      </form>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-700">
                <th class="px-4 py-3">
                  Name
                </th>
                <th class="px-4 py-3">
                  Plugin Count
                </th>
                <th class="px-4 py-3">
                  Status
                </th>
                <th class="px-4 py-3">
                  Created Date
                </th>
                <th class="px-4 py-3">
                  Actions
                </th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @forelse ($tags as $tag)
              <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm">
                  <p class="font-semibold">
                    {{ $tag->name }}
                  </p>
                </td>
                <td class="px-4 py-3 text-sm">-</td>
                <td class="px-4 py-3 text-xs">
                  <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                      In Use
                  </span>
                </td>
                <td class="px-4 py-3 text-sm">{{ $tag->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-3">
                  <div class="flex items-center space-x-4 text-sm">

                    <a href="{{ route('tags.edit', $tag->slug) }}" type="button"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                       aria-label="Edit">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                           xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" clip-rule="evenodd"></path>
                      </svg>
                      <span class="sr-only">
                        Icon description
                      </span>
                    </a>

                    <form method="POST" action="{{ route('tags.destroy', $tag->slug) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" aria-label="Delete">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">
                          Icon description
                        </span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm text-center" colspan="5">
                  No Tags Available
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
