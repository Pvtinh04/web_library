

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js"></script>


<div>
    <div id="select_book" class="d-flex" x-data="select_book">
        <div>Sách</div>
        <select x-ref="select" style="width: 200px" multiple="multiple">
<!--            <template x-for="book in books">-->
<!--                <option x-bind:value="book.id" x-text="book.name"></option>-->
<!--            </template>-->
        </select>
    </div>
    <div id="select_user" class="d-flex" x-data="select_user">
        <div>Nguoi dung</div>
        <select x-ref="select" style="width: 200px" multiple="multiple">
<!--            <template x-for="user in users">-->
<!--                <option x-bind:value="user.id" x-text="user.name"></option>-->
<!--            </template>-->
        </select>
    </div>

    <div id="select_status" class="d-flex" x-data="select_status">
        <div>Trang thai</div>
        <select x-ref="select" style="width: 200px" >
<!--            <template x-for="item in status">-->
<!--                <option x-bind:value="item.key" x-text="item.value"></option>-->
<!--            </template>-->
        </select>
    </div>
    <div id="select_late_date" class="d-flex" x-data="select_late_date">
        <div>So ngay qua han</div>
        <select x-bind:disabled="disabled" x-ref="select" style="width: 200px" >
<!--            <template x-for="item in date">-->
<!--                <option x-bind:value="item.key" x-text="item.value"></option>-->
<!--            </template>-->
        </select>
    </div>

    <div x-data="button_action">
        <button class="btn btn-success" x-on:click="reset">Reset</button>
        <button class="btn btn-primary" @click="search">Search</button>
    </div>

</div>

<script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
<script>
    // $(document).ready(() => {

    function getStatusTransaction(plan,actual) {
        if (!!actual) return 'Đã trả'
        const now = dayjs();
        const planDate = dayjs(plan);
        if (planDate.isBefore(now)) {
            return "Quá hạn "
        }
        return "Đang mượn"
    }

    document.addEventListener("alpine:init", async () => {

        Alpine.store("app", {
            book_id: [],
            user_id: [],
            status: null,
            late_date: null,
            transactions: [],
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
                    this.user_id = this.user.filter(item => item !== id);
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

                this.transactions = JSON.parse(`<?=json_encode($transactions)?>`);
                console.log(this.transactions.map(item => ({
                    ...item,
                    status: getStatusTransaction(item.return_plan_date,item.return_actual_date)
                })))
            }
        })

        Alpine.data('select_book', () => ({
            books: [],
            init() {
                const books = JSON.parse(`<?=json_encode($books)?>`)
                this.books = books;
                this.$watch("$store.app.book_id",val => {
                    console.log("book_id",val);
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
                            {id: "",text: ""}
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").changeBook(event.params.data.id)
                    })
                    select2.on("select2:unselect",event => {
                        Alpine.store("app").changeBook(event.params.data.id)
                    })
                    select2.on("select2:clear",event => {
                        console.log("clear")
                        Alpine.store("app").book_id = [];
                    })

                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("select_user",() => ({
            users: [],
            init() {
                const users = JSON.parse(`<?=json_encode($users,JSON_UNESCAPED_UNICODE)?>`);
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
                                id: "",text:""
                            }
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").changeUser(event.params.data.id)
                    })
                    select2.on("select2:unselect",event => {
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
                    key: 1,
                    value: "Đang mượn"
                },
                {
                    key: 2,
                    value: "Đã trả"
                },
                {
                    key: 3,
                    value: "Quá hạn"
                }
            ],
            init() {
                $(document).ready(() => {
                    const select2 = $(this.$refs.select).select2({
                        // allowClear: true,
                        placeholder: "Chọn trạng thái",
                        data: [
                            {id: "",text: ""},
                            ...this.status.map(item => ({
                                id: item.key,
                                text: item.value
                            }))
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").status = Number(event.params.data.id);
                    })
                    select2.on("select2:unselect",event => {
                        // Alpine.store("full_page").changeUser(event.params.data.id)
                        Alpine.store("app").status = null;
                    })
                    window.addEventListener("reset", () => {
                        select2.val("").trigger("change")
                    })
                })
            }
        }))

        Alpine.data("select_late_date",() => ({
            date: [
                {
                    key: 1,
                    value: "Dưới 1 ngày"
                },
                {
                    key: 2,
                    value: "Từ 1-5 ngày"
                },
                {
                    key: 3,
                    value: "Trên 10 ngày"
                }
            ],
            disabled: true,
            init() {
                $(document).ready(() => {
                    const select2 = $(this.$refs.select).select2({
                        // allowClear: true,
                        placeholder: "Chọn ngày quá hạn",
                        data: [
                            ...this.date.map(item => ({
                                id: item.key,
                                text: item.value
                            })),
                            {id: "",text:""}
                        ]
                    })
                    select2.on("select2:select", event => {
                        Alpine.store("app").late_date = Number(event.params.data.id);
                    })
                    select2.on("select2:unselect",event => {
                        // Alpine.store("full_page").changeUser(event.params.data.id)
                        Alpine.store("app").late_date = null;
                    })
                    this.$watch("$store.app.status",val => {
                        if (Number(val) === 3) {
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
            reset(){
                const event = new CustomEvent("reset");
                window.dispatchEvent(event)
            },
            search() {
                console.log("search")
            }
        }))
        // Alpine.start()
    })
    // })

</script>