<div class="text-white font-londrina" x-text="timeRemaining()" :style="fontSize()"></div>

@push('scripts')
   <script>
        function timer() {
            return {
                minutes: {{ request('minutes', 5) }},
                size: {{ request('size', 96) }},
                endedText: "{{ request('endedText', 'About to start!') }}",
                duration: null,
                countdown: null,
                copied: false,
                fontSize() {
                    return 'font-size: ' + this.size + 'px'
                },
                start() {
                    this.duration = this.minutes * 60 * 1000

                    this.countdown = setInterval(() => {
                        if (this.timeEnded()) {
                            clearInterval(this.countdown)
                            return
                        }

                        this.duration -= 1000
                    }, 1000)

                    this.$watch('minutes', value => {
                        this.duration = this.minutes * 60 * 1000
                    })
                },
                timeEnded() {
                    return this.duration <= 0
                },
                timeRemaining() {
                    if (this.timeEnded()) {
                        return this.endedText
                    }
                    var minutes = Math.floor(this.duration / 60000);
                    var seconds = ((this.duration % 60000) / 1000).toFixed(0);
                    return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
                },
                copyUrl(event) {
                    let urlParams = new URLSearchParams(new FormData(this.$refs.timerForm)).toString()
                    fetch(this.$refs.timerForm.getAttribute('action') + '/?' + urlParams).then(response => {
                        let copyElement = document.createElement('input')
                        document.body.appendChild(copyElement)
                        copyElement.value = response.url
                        copyElement.select()
                        document.execCommand('copy')
                        document.body.removeChild(copyElement)
                        this.copied = true
                        setTimeout(() => {
                            this.copied = false
                        }, 3000);
                    })
                }
            }
        }
   </script>
@endpush