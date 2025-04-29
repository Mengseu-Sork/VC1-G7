<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg mb-16 p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-left ml-1 text-2xl font-bold mb-6">History Order</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Order no.</th>
                            <th class="py-3 px-6 text-left">Order date</th>
                            <th class="py-3 px-6 text-left">Bill-to name</th>
                            <th class="py-3 px-6 text-left">Total</th>
                            <th class="py-3 px-6 text-left">Track & trace number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <td class="py-3 px-6 font-semibold">SO-1606070005</td>
                            <td class="py-3 px-6 font-semibold">6/7/2016</td>
                            <td class="py-3 px-6 font-semibold">John Doe</td>
                            <td class="py-3 px-6 font-semibold">$318.24</td>
                            <td class="py-3 px-6 font-semibold">
                                <a href="#" class="text-blue-500 hover:underline">› View details</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
