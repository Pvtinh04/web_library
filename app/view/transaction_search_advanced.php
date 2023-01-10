<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js"></script>
<style>
    .right {
        margin-left: 50px;
    }

    .select > div:first-child {
        margin-top: 3px;
        margin-right: 15px;
    }
</style>


<div>
    <div class="d-flex justify-content-center mt-4">
        <div id="select_book" class="d-flex select" x-data="select_book">
            <div>Sách</div>
            <select x-ref="select" style="width: 200px" multiple="multiple">
                <!--            <template x-for="book in books">-->
                <!--                <option x-bind:value="book.id" x-text="book.name"></option>-->
                <!--            </template>-->
            </select>
        </div>
        <div id="select_user" class="d-flex ml-3 right select" x-data="select_user">
            <div>Nguoi dung</div>
            <select x-ref="select" style="width: 200px" multiple="multiple">
                <!--            <template x-for="user in users">-->
                <!--                <option x-bind:value="user.id" x-text="user.name"></option>-->
                <!--            </template>-->
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div id="select_status" class="d-flex select" x-data="select_status">
            <div>Trang thai</div>
            <select x-ref="select" style="width: 200px">
                <!--            <template x-for="item in status">-->
                <!--                <option x-bind:value="item.key" x-text="item.value"></option>-->
                <!--            </template>-->
            </select>
        </div>
        <div id="select_late_date" class="d-flex ml-3 right select" x-data="select_late_date">
            <div>So ngay qua han</div>
            <select x-bind:disabled="disabled" x-ref="select" style="width: 200px">
                <!--            <template x-for="item in date">-->
                <!--                <option x-bind:value="item.key" x-text="item.value"></option>-->
                <!--            </template>-->
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div x-data="button_action">
            <button class="btn btn-success" x-on:click="reset">Reset</button>
            <button x-bind:disabled="$store.app.isLoading" class="btn btn-primary" @click="search">Search</button>
        </div>
    </div>

    <div x-data>
        <div>Số lượng bản ghi tìm thấy : <span x-text="$store.app.transactions.length"></span></div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Người dùng</th>
                <th scope="col">Tình trạng mượn</th>

            </tr>
            </thead>
            <tbody x-data>
            <template x-for="(item,index) in $store.app.transactions">
                <tr>
                    <th scope="row" x-text="index+1"></th>
                    <td x-text="item.book_name"></td>
                    <td x-text="item.user_name">Otto</td>
                    <td x-text="item.status.text"></td>
                </tr>
            </template>

            </tbody>
        </table>
    </div>
</div>

<script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
<script>
    // $(document).ready(() => {

    const BORROWING = 1;
    const LATE = 2;
    const RESOLVE = 3;

    function getStatusTransaction(plan, actual) {
        if (!!actual) return {
            text: 'Đã trả',
            key: RESOLVE
        }
        const now = dayjs();
        const planDate = dayjs(plan);
        if (planDate.isBefore(now)) {
            const distance = now.diff(planDate, 'day')
            return {
                key: LATE,
                date: distance,
                text: `Quá hạn ${distance} ngày`
            }
        }
        return {
            text: "Đang mượn",
            key: BORROWING
        }
    }

    document.addEventListener("alpine:init", async () => {

        Alpine.store("app", {
            book_id: [],
            user_id: [],
            status: null,
            late_date: null,
            transactions: [],
            originTransaction: [],
            isLoading: false,
            changeBook(id) {
                id = Number(id);
                if (this.book_id.includes(id)) {
                    this.book_id = this.book_id.filter(item => item !== id);
                } else {
                    this.book_id.push(id);
                }
            },
            changeUser(id) {
                id = Number(id);
                if (this.user_id.includes(id)) {
                    this.user_id = this.user_id.filter(item => item !== id);
                } else {
                    this.user_id.push(id);
                }
            },
            init() {
                window.addEventListener("reset", () => {
                    this.book_id = [];
                    this.user_id = [];
                    this.status = null;
                    this.late_date = null;
                })

                // this.getTransactions()
                const transactions = JSON.parse(`<?=json_encode($transactions)?>`);
                this.transactions = transactions.map(item => ({
                    ...item,
                    status: getStatusTransaction(item.return_plan_date, item.return_actual_date)
                }))
                this.originTransaction = [...this.transactions];
            },
            async getTransactions() {
                const params = new URLSearchParams("");
                params.append("page", "transaction");
                params.append("action", "query");
                params.append("type", "json");
                if (this.book_id.length > 0) {
                    params.append("book_id", this.book_id.join(","))
                }
                if (this.user_id.length > 0) {
                    params.append("user_id", this.user_id.join(","))
                }

                if (!!this.status) {
                    params.append("status", this.status);
                }


                try {
                    this.isLoading = true;
                    const response = await fetch(`index.php?${params.toString()}`);
                    const data = await response.json();
                    this.transactions = data.data.map(item => ({
                        ...item,
                        status: getStatusTransaction(item.return_plan_date, item.return_actual_date)
                    }))
                    this.originTransaction = [...this.transactions];
                } finally {
                    this.isLoading = false;
                }
            },
            async filter() {
                const params = new URLSearchParams(window.location.href);
                if (params.get("search") === "server") {
                    await this.getTransactions();
                }
                this.transactions = this.originTransaction.filter(item => {
                    const check = [];
                    if (this.book_id.length > 0) {
                        check.push(this.book_id.includes(Number(item.book_id)))
                    }
                    if (this.user_id.length > 0) {
                        check.push(this.user_id.includes(Number(item.user_id)))
                    }
                    if (!!this.status) {
                        check.push(item.status.key === this.status)
                    }

                    if (this.status === LATE) {
                        if (this.late_date === 1) {
                            check.push(item?.status?.date <= 1)
                        } else if (this.late_date === 2) {
                            check.push(item?.status?.date >= 2 && item?.status?.date <= 5)
                        } else if (this.late_date == 3) {
                            check.push(item?.status?.date >= 5 && item?.status?.date <= 10)
                        } else if (this.late_date === 4) {
                            check.push(item?.status?.date > 10)
                        }
                    }
                    return check.every((item) => item);
                })
            }
        })

        Alpine.data('select_book', () => ({
            books: [],
            init() {
                const books = JSON.parse(`<?=json_encode($books)?>`)
                this.books = books;
                this.$watch("$store.app.book_id", val => {
                    console.log("book_id", val);
                })
                $(document).ready(() => {
                    // $("#select_book").select2()

                    const select2 = $(this.$refs.select).select2({
                        // allowClear: true,
                        placeholder: "Chọn sách",
                        data: [
                            ...this.books.map(item => ({
                                id: item.id,
                                text: item.name
                            })),
                            {id: "", text: ""}
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").changeBook(event.params.data.id)
                    })
                    select2.on("select2:unselect", event => {
                        Alpine.store("app").changeBook(event.params.data.id)
                    })
                    select2.on("select2:clear", event => {
                        console.log("clear")
                        Alpine.store("app").book_id = [];
                    })

                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("select_user", () => ({
            users: [],
            init() {
                const users = JSON.parse(`<?=json_encode($users, JSON_UNESCAPED_UNICODE)?>`);
                this.users = users;
                $(document).ready(() => {
                    const select2 = $(this.$refs.select).select2({
                        // allowClear: true,
                        placeholder: "Chọn người dùng",
                        data: [
                            ...this.users.map(item => ({
                                id: item.id,
                                text: item.name
                            })),
                            {
                                id: "", text: ""
                            }
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").changeUser(event.params.data.id)
                    })
                    select2.on("select2:unselect", event => {
                        Alpine.store("app").changeUser(event.params.data.id)
                    })
                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("select_status", () => ({
            status: [
                {
                    key: BORROWING,
                    value: "Đang mượn"
                },
                {
                    key: RESOLVE,
                    value: "Đã trả"
                },
                {
                    key: LATE,
                    value: "Quá hạn"
                }
            ],
            init() {
                $(document).ready(() => {
                    const select2 = $(this.$refs.select).select2({
                        allowClear: true,
                        placeholder: "Chọn trạng thái",
                        data: [
                            {id: "", text: ""},
                            ...this.status.map(item => ({
                                id: item.key,
                                text: item.value
                            }))
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").status = Number(event.params.data.id);
                    })
                    select2.on("select2:unselect", event => {
                        // Alpine.store("full_page").changeUser(event.params.data.id)
                        Alpine.store("app").status = null;
                    })
                    select2.on("select2:clear", event => {
                        Alpine.store("app").status = null;
                    })
                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("select_late_date", () => ({
            date: [
                {
                    key: 1,
                    value: "Dưới 1 ngày"
                },
                {
                    key: 2,
                    value: "Từ 2-5 ngày"
                },
                {
                    key: 3,
                    value: 'Từ 6-10 ngày'
                },
                {
                    key: 4,
                    value: "Trên 10 ngày"
                }
            ],
            disabled: true,
            init() {
                $(document).ready(() => {
                    const select2 = $(this.$refs.select).select2({
                        allowClear: true,
                        placeholder: "Chọn ngày quá hạn",
                        data: [
                            ...this.date.map(item => ({
                                id: item.key,
                                text: item.value
                            })),
                            {id: "", text: ""}
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").late_date = Number(event.params.data.id);
                    })
                    select2.on("select2:unselect", event => {
                        // Alpine.store("full_page").changeUser(event.params.data.id)
                        Alpine.store("app").late_date = null;
                    })
                    select2.on("select2:clear", event => {
                        Alpine.store("app").late_date = null;
                    })
                    this.$watch("$store.app.status", val => {
                        if (Number(val) === LATE) {
                            this.disabled = false;
                        } else {
                            Alpine.store("app").late_date = null;
                            this.disabled = true;
                        }
                    })
                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("button_action", () => ({
            reset() {
                const event = new CustomEvent("reset");
                window.dispatchEvent(event)
            },
            search() {
                Alpine.store("app").filter()
            }
        }))
        // Alpine.start()
    })
    // })

</script>