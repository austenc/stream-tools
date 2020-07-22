<div x-text="timeRemaining()" :style="getStyles()"></div>

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        function timer() {
            return {
                minutes: {{ request('minutes', 5) }},
                size: {{ request('size', 96) }},
                textColor: "{{ request('textColor', '#FFFFFF') }}",
                endedText: "{{ request('endedText', 'About to start!') }}",
                fontFamily: "{{ request('fontFamily', 'Londrina Solid') }}",
                duration: null,
                countdown: null,
                copied: false,
                getStyles() {
                    return 'font-size: ' + this.size + 'px; '
                        + 'color: ' + this.textColor + '; '
                        + "font-family: '" + this.fontFamily + "'; "
                },
                start() {
                    this.loadFont()

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
                },
                loadFont() {
                    WebFont.load({
                      google: { families: [this.fontFamily] }
                    });
                }
            }
        }
    </script>
@endpush