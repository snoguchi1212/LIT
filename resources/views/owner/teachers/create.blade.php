<x-app-layout>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
            <div>講師追加画面</div>
            <button onclick="location.href='{{ route('owner.teachers.createFromCSV') }}'" class="ml-auto mr-0 text-white bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-600 rounded text-lg">CSVから登録する</button>
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="post" action="{{ route('owner.teachers.store') }}">
                            @csrf
                            <div class="p-2 -m-2 w-2/4">
                                <label for="sex" class="pr-2 leading-7 text-sm text-gray-600">性別</label>
                                <div>
                                    <select id="sex" name="sex">
                                        @foreach (SexConsts::SEX_LIST as $number => $name )
                                        <option value="{{ $number }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="family_name" class="leading-7 text-sm text-gray-600">姓</label>
                                    <input type="text" id="family_name" name="family_name" value="{{ old('family_name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="first_name" class="leading-7 text-sm text-gray-600">名</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="family_name_kana" class="leading-7 text-sm text-gray-600">セイ</label>
                                    <input type="text" id="family_name_kana" name="family_name_kana" value="{{ old('family_name_kana') }}" pattern="[\u30A1-\u30FC]*" title="全角カタカナ" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="first_name_kana" class="leading-7 text-sm text-gray-600">メイ</label>
                                    <input type="text" id="first_name_kana" name="first_name_kana" value="{{ old('first_name_kana') }}" pattern="[\u30A1-\u30FC]*" title="全角カタカナ" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                            </div>
                            <div class="p-2 -m-2">
                                <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            {{-- #TODO:パスワードは、初期設定でメールアドレスにして、変更を促すようにする--}}
                            <div class="p-2 -m-2">
                                <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                <input type="password" id="password" name="password" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="p-2 -m-2">
                                <label for="password_confirmation" class="leading-7 text-sm text-gray-600">パスワード(確認用)</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="mt-4 p-2 w-full flex justify-around">
                                <button type="button" onclick="location.href='{{ route('owner.teachers.index') }}'" class=" text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                                <button type="submit" class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
