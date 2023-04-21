

<x-tests.app>
<x-slot name="header">ヘッダー１</x-slot>
コンポーネント１

<x-tests.card title="タイトル１" content="本文１" :message="$message"></x-tests.card>
<x-tests.card title="css変更" class="bg-pink-500"></x-tests.card>
</x-tests.app>