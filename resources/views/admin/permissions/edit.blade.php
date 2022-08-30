<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="p-4">
                    <a href="{{ route('admin.permissions.index') }}"
                        class="px-4 py-2 bg-red-700 hover:bg-red-500 text-slate-100 rounded-md"
                        >Back</a>
                </div>
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <div class="flex flex-col">
                        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                            <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                                @csrf
                                @method('PUT')
                              <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Permission name </label>
                                <div class="mt-1">
                                  <input value="{{ $permission->name }}" type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                              </div>
                              <div class="sm:col-span-6 pt-5">
                                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
                              </div>
                            </form>
                          </div>

                    </div>
                </div>

                <div class="mt-6 p-2">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="mt-4 p-2">
                        @if ($permission->roles)
                            @foreach ($role->permissions as $permission_role)
                            <form class="text-blue-700 " method="POST" action="{{ route('admin.permissions.roles.remove',[$permission->id,$permission_role->id]) }}" onsubmit="return confirm('Are you sure?');" >
                                @csrf
                                @method('DELETE')
                                <button class="underline" type="submit">{{ $permission_role->name }}</button>
                            </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl">
                        <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                            @csrf

                            <div class="sm:col-span-6">
                                <div class="sm:col-span-6">
                                    <label for="role"
                                        class="block text-sm font-medium text-gray-700">Roles</label>
                                    <select id="role" name="role" autocomplete="role-name"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
