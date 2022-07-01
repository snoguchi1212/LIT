<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒追加画面
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
                            <form method="post" action="{{ route('owner.students.store') }}">
                            @csrf
                                {{-- #TODO: 学年の入力をドロップダウンに --}}
                                <div class="p-2 -m-2 w-1/4">
                                    <label for="grade" class="leading-7 text-sm text-gray-600">学年</label>
                                    <input type="text" id="grade" name="grade" value="{{ old('grade') }}" inputmode="numeric" pattern="^([1-7]{1})$" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                {{-- #TODO:学校も入力項目に加える --}}
                                {{-- #TODO:性別も入力項目に加える --}}
                                {{-- #TODO:文理選択も入力項目に加える --}}
                                <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="family_name" class="leading-7 text-sm text-gray-600">姓</label>
                                    <input type="text" id="family_name" name="family_name" value="{{ old('family_name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="last_name" class="leading-7 text-sm text-gray-600">名</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                                    <label for="last_name_kana" class="leading-7 text-sm text-gray-600">メイ</label>
                                    <input type="text" id="last_name_kana" name="last_name_kana" value="{{ old('family_name_kana') }}" pattern="[\u30A1-\u30FC]*" title="全角カタカナ" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                                <button type="button" onclick="location.href='{{ route('owner.students.index') }}'" class=" text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
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
