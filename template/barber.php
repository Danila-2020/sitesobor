<!-- CSS - Стили для подключения(аналог barber.css) -->
	<?php
	function getStyles() {
    ob_start(); // Начинаем буферизацию вывода
	?>
<style amp-custom="">
html {
	font-family: sans-serif;
	line-height: 1.15;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%
}

body {
	margin: 0;
	font-size: 120%;
}

article, aside, footer, header, nav, section {
	display: block
}

h1 {
	font-size: 2em;
	margin: .67em 0
}

figcaption, figure, main {
	display: block
}

figure {
	margin: 1em 40px
}

hr {
	box-sizing: content-box;
	height: 0;
	overflow: visible
}

pre {
	font-family: monospace, monospace;
	font-size: 1em
}

a {
	background-color: transparent;
	-webkit-text-decoration-skip: objects
}

a:active, a:hover {
	outline-width: 0
}

abbr[title] {
	border-bottom: none;
	text-decoration: underline;
	text-decoration: underline dotted
}

b, strong {
	font-weight: inherit;
	font-weight: bolder
}

code, kbd, samp {
	font-family: monospace, monospace;
	font-size: 1em
}

dfn {
	font-style: italic
}

mark {
	background-color: #ff0;
	color: #000
}

small {
	font-size: 80%
}

sub, sup {
	font-size: 75%;
	line-height: 0;
	position: relative;
	vertical-align: baseline
}

sub {
	bottom: -.25em
}

sup {
	top: -.5em
}

audio, video {
	display: inline-block
}

audio:not([controls]) {
	display: none;
	height: 0
}

img {
	border-style: none
}

svg:not(:root) {
	overflow: hidden
}

button, input, optgroup, select, textarea {
	font-family: sans-serif;
	font-size: 100%;
	line-height: 1.15;
	margin: 0
}

button, input {
	overflow: visible
}

button, select {
	text-transform: none
}

[type=reset], [type=submit], button, html [type=button] {
	-webkit-appearance: button
}

[type=button]::-moz-focus-inner, [type=reset]::-moz-focus-inner, [type=submit]::-moz-focus-inner, button::-moz-focus-inner {
	border-style: none;
	padding: 0
}

[type=button]:-moz-focusring, [type=reset]:-moz-focusring, [type=submit]:-moz-focusring, button:-moz-focusring {
	outline: 1px dotted ButtonText
}

fieldset {
	border: 1px solid silver;
	margin: 0 2px;
	padding: .35em .625em .75em
}

legend {
	box-sizing: border-box;
	color: inherit;
	display: table;
	max-width: 100%;
	padding: 0;
	white-space: normal
}

progress {
	display: inline-block;
	vertical-align: baseline
}

textarea {
	overflow: auto
}

[type=checkbox], [type=radio] {
	box-sizing: border-box;
	padding: 0
}

[type=number]::-webkit-inner-spin-button, [type=number]::-webkit-outer-spin-button {
	height: auto
}

[type=search] {
	-webkit-appearance: textfield;
	outline-offset: -2px
}

[type=search]::-webkit-search-cancel-button, [type=search]::-webkit-search-decoration {
	-webkit-appearance: none
}

::-webkit-file-upload-button {
	-webkit-appearance: button;
	font: inherit
}

details, menu {
	display: block
}

summary {
	display: list-item
}

canvas {
	display: inline-block
}

[hidden], template {
	display: none
}

.h00 {
	font-size: 4rem
}

.h0 {
	font-size: 2.8125rem
}

.h1 {
	font-size: 2.5rem
}

.h2 {
	font-size: 1.625rem
}

.h3 {
	font-size: 1.3125rem
}

.h4 {
	font-size: 1.125rem
}

.h5 {
	font-size: 1rem
}

.h6 {
	font-size: .9375rem
}

.font-family-inherit {
	font-family: inherit
}

.font-size-inherit {
	font-size: inherit
}

.text-decoration-none {
	text-decoration: none
}

.bold {
	font-weight: 700
}

.regular {
	font-weight: 400
}

.italic {
	font-style: italic
}

.caps {
	text-transform: uppercase;
	letter-spacing: .2em
}

.left-align {
	text-align: left
}

.center {
	text-align: center
}

.right-align {
	text-align: right
}

.justify {
	text-align: justify
}

.nowrap {
	white-space: nowrap
}

.break-word {
	word-wrap: break-word
}

.line-height-1 {
	line-height: 1.11111
}

.line-height-2 {
	line-height: 1.42857
}

.line-height-3 {
	line-height: 1.6
}

.line-height-4 {
	line-height: 2.0625
}

.list-style-none {
	list-style: none
}

.underline {
	text-decoration: underline
}

.truncate {
	max-width: 100%;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap
}

.list-reset {
	list-style: none;
	padding-left: 0
}

.inline {
	display: inline
}

.block {
	display: block
}

.inline-block {
	display: inline-block
}

.table {
	display: table
}

.table-cell {
	display: table-cell
}

.overflow-hidden {
	overflow: hidden
}

.overflow-scroll {
	overflow: scroll
}

.overflow-auto {
	overflow: auto
}

.clearfix:after, .clearfix:before {
	content: " ";
	display: table
}

.clearfix:after {
	clear: both
}

.left {
	float: left
}

.right {
	float: right
}

.fit {
	max-width: 100%
}

.max-width-1 {
	max-width: 24rem
}

.max-width-2 {
	max-width: 32rem
}

.max-width-3 {
	max-width: 48rem
}

.max-width-4 {
	max-width: 64rem
}

.border-box {
	box-sizing: border-box
}

.align-baseline {
	vertical-align: baseline
}

.align-top {
	vertical-align: top
}

.align-middle {
	vertical-align: middle
}

.align-bottom {
	vertical-align: bottom
}

.m0 {
	margin: 0
}

.mt0 {
	margin-top: 0
}

.mr0 {
	margin-right: 0
}

.mb0 {
	margin-bottom: 0
}

.ml0, .mx0 {
	margin-left: 0
}

.mx0 {
	margin-right: 0
}

.my0 {
	margin-top: 0;
	margin-bottom: 0
}

.m1 {
	margin: .5rem
}

.mt1 {
	margin-top: .5rem
}

.mr1 {
	margin-right: .5rem
}

.mb1 {
	margin-bottom: .5rem
}

.ml1, .mx1 {
	margin-left: .5rem
}

.mx1 {
	margin-right: .5rem
}

.my1 {
	margin-top: .5rem;
	margin-bottom: .5rem
}

.m2 {
	margin: 1rem
}

.mt2 {
	margin-top: 1rem
}

.mr2 {
	margin-right: 1rem
}

.mb2 {
	margin-bottom: 1rem
}

.ml2, .mx2 {
	margin-left: 1rem
}

.mx2 {
	margin-right: 1rem
}

.my2 {
	margin-top: 1rem;
	margin-bottom: 1rem
}

.m3 {
	margin: 1.5rem
}

.mt3 {
	margin-top: 1.5rem
}

.mr3 {
	margin-right: 1.5rem
}

.mb3 {
	margin-bottom: 1.5rem
}

.ml3, .mx3 {
	margin-left: 1.5rem
}

.mx3 {
	margin-right: 1.5rem
}

.my3 {
	margin-top: 1.5rem;
	margin-bottom: 1.5rem
}

.m4 {
	margin: 2.5rem
}

.mt4 {
	margin-top: 2.5rem
}

.mr4 {
	margin-right: 2.5rem
}

.mb4 {
	margin-bottom: 2.5rem
}

.ml4, .mx4 {
	margin-left: 2.5rem
}

.mx4 {
	margin-right: 2.5rem
}

.my4 {
	margin-top: 2.5rem;
	margin-bottom: 2.5rem
}

.mxn1 {
	margin-left: calc(.5rem * -1);
	margin-right: calc(.5rem * -1)
}

.mxn2 {
	margin-left: calc(1rem * -1);
	margin-right: calc(1rem * -1)
}

.mxn3 {
	margin-left: calc(1.5rem * -1);
	margin-right: calc(1.5rem * -1)
}

.mxn4 {
	margin-left: calc(2.5rem * -1);
	margin-right: calc(2.5rem * -1)
}

.m-auto {
	margin: auto
}

.mt-auto {
	margin-top: auto
}

.mr-auto {
	margin-right: auto
}

.mb-auto {
	margin-bottom: auto
}

.ml-auto, .mx-auto {
	margin-left: auto
}

.mx-auto {
	margin-right: auto
}

.my-auto {
	margin-top: auto;
	margin-bottom: auto
}

.p0 {
	padding: 0
}

.pt0 {
	padding-top: 0
}

.pr0 {
	padding-right: 0
}

.pb0 {
	padding-bottom: 0
}

.pl0, .px0 {
	padding-left: 0
}

.px0 {
	padding-right: 0
}

.py0 {
	padding-top: 0;
	padding-bottom: 0
}

.p1 {
	padding: .5rem
}

.pt1 {
	padding-top: .5rem
}

.pr1 {
	padding-right: .5rem
}

.pb1 {
	padding-bottom: .5rem
}

.pl1 {
	padding-left: .5rem
}

.py1 {
	padding-top: .5rem;
	padding-bottom: .5rem
}

.px1 {
	padding-left: .5rem;
	padding-right: .5rem
}

.p2 {
	padding: 1rem
}

.pt2 {
	padding-top: 1rem
}

.pr2 {
	padding-right: 1rem
}

.pb2 {
	padding-bottom: 1rem
}

.pl2 {
	padding-left: 1rem
}

.py2 {
	padding-top: 1rem;
	padding-bottom: 1rem
}

.px2 {
	padding-left: 1rem;
	padding-right: 1rem
}

.p3 {
	padding: 1.5rem
}

.pt3 {
	padding-top: 1.5rem
}

.pr3 {
	padding-right: 1.5rem
}

.pb3 {
	padding-bottom: 1.5rem
}

.pl3 {
	padding-left: 1.5rem
}

.py3 {
	padding-top: 1.5rem;
	padding-bottom: 1.5rem
}

.px3 {
	padding-left: 1.5rem;
	padding-right: 1.5rem
}

.p4 {
	padding: 2.5rem
}

.pt4 {
	padding-top: 2.5rem
}

.pr4 {
	padding-right: 2.5rem
}

.pb4 {
	padding-bottom: 2.5rem
}

.pl4 {
	padding-left: 2.5rem
}

.py4 {
	padding-top: 2.5rem;
	padding-bottom: 2.5rem
}

.px4 {
	padding-left: 2.5rem;
	padding-right: 2.5rem
}

.col {
	float: left
}

.col, .col-right {
	box-sizing: border-box
}

.col-right {
	float: right
}

.col-1 {
	width: 8.33333%
}

.col-2 {
	width: 16.66667%
}

.col-3 {
	width: 25%
}

.col-4 {
	width: 33.33333%
}

.col-5 {
	width: 41.66667%
}

.col-6 {
	width: 50%
}

.col-7 {
	width: 58.33333%
}

.col-8 {
	width: 66.66667%
}

.col-9 {
	width: 75%
}

.col-10 {
	width: 83.33333%
}

.col-11 {
	width: 91.66667%
}

.col-12 {
	width: 100%
}

@media (min-width:40.06rem) {
	.sm-col {
		float: left;
		box-sizing: border-box
	}

	.sm-col-right {
		float: right;
		box-sizing: border-box
	}

	.sm-col-1 {
		width: 8.33333%
	}

	.sm-col-2 {
		width: 16.66667%
	}

	.sm-col-3 {
		width: 25%
	}

	.sm-col-4 {
		width: 33.33333%
	}

	.sm-col-5 {
		width: 41.66667%
	}

	.sm-col-6 {
		width: 50%
	}

	.sm-col-7 {
		width: 58.33333%
	}

	.sm-col-8 {
		width: 66.66667%
	}

	.sm-col-9 {
		width: 75%
	}

	.sm-col-10 {
		width: 83.33333%
	}

	.sm-col-11 {
		width: 91.66667%
	}

	.sm-col-12 {
		width: 100%
	}

}

@media (min-width:52.06rem) {
	.md-col {
		float: left;
		box-sizing: border-box
	}

	.md-col-right {
		float: right;
		box-sizing: border-box
	}

	.md-col-1 {
		width: 8.33333%
	}

	.md-col-2 {
		width: 16.66667%
	}

	.md-col-3 {
		width: 25%
	}

	.md-col-4 {
		width: 33.33333%
	}

	.md-col-5 {
		width: 41.66667%
	}

	.md-col-6 {
		width: 50%
	}

	.md-col-7 {
		width: 58.33333%
	}

	.md-col-8 {
		width: 66.66667%
	}

	.md-col-9 {
		width: 75%
	}

	.md-col-10 {
		width: 83.33333%
	}

	.md-col-11 {
		width: 91.66667%
	}

	.md-col-12 {
		width: 100%
	}

}

@media (min-width:64.06rem) {
	.lg-col {
		float: left;
		box-sizing: border-box
	}

	.lg-col-right {
		float: right;
		box-sizing: border-box
	}

	.lg-col-1 {
		width: 8.33333%
	}

	.lg-col-2 {
		width: 16.66667%
	}

	.lg-col-3 {
		width: 25%
	}

	.lg-col-4 {
		width: 33.33333%
	}

	.lg-col-5 {
		width: 41.66667%
	}

	.lg-col-6 {
		width: 50%
	}

	.lg-col-7 {
		width: 58.33333%
	}

	.lg-col-8 {
		width: 66.66667%
	}

	.lg-col-9 {
		width: 75%
	}

	.lg-col-10 {
		width: 83.33333%
	}

	.lg-col-11 {
		width: 91.66667%
	}

	.lg-col-12 {
		width: 100%
	}

}

.flex {
	display: -ms-flexbox;
	display: flex
}

@media (min-width:40.06rem) {
	.sm-flex {
		display: -ms-flexbox;
		display: flex
	}

}

@media (min-width:52.06rem) {
	.md-flex {
		display: -ms-flexbox;
		display: flex
	}

}

@media (min-width:64.06rem) {
	.lg-flex {
		display: -ms-flexbox;
		display: flex
	}

}

.flex-column {
	-ms-flex-direction: column;
	flex-direction: column
}

.flex-wrap {
	-ms-flex-wrap: wrap;
	flex-wrap: wrap
}

.items-start {
	-ms-flex-align: start;
	align-items: flex-start
}

.items-end {
	-ms-flex-align: end;
	align-items: flex-end
}

.items-center {
	-ms-flex-align: center;
	align-items: center
}

.items-baseline {
	-ms-flex-align: baseline;
	align-items: baseline
}

.items-stretch {
	-ms-flex-align: stretch;
	align-items: stretch
}

.self-start {
	-ms-flex-item-align: start;
	align-self: flex-start
}

.self-end {
	-ms-flex-item-align: end;
	align-self: flex-end
}

.self-center {
	-ms-flex-item-align: center;
	-ms-grid-row-align: center;
	align-self: center
}

.self-baseline {
	-ms-flex-item-align: baseline;
	align-self: baseline
}

.self-stretch {
	-ms-flex-item-align: stretch;
	-ms-grid-row-align: stretch;
	align-self: stretch
}

.justify-start {
	-ms-flex-pack: start;
	justify-content: flex-start
}

.justify-end {
	-ms-flex-pack: end;
	justify-content: flex-end
}

.justify-center {
	-ms-flex-pack: center;
	justify-content: center
}

.justify-between {
	-ms-flex-pack: justify;
	justify-content: space-between
}

.justify-around {
	-ms-flex-pack: distribute;
	justify-content: space-around
}

.justify-evenly {
	-ms-flex-pack: space-evenly;
	justify-content: space-evenly
}

.content-start {
	-ms-flex-line-pack: start;
	align-content: flex-start
}

.content-end {
	-ms-flex-line-pack: end;
	align-content: flex-end
}

.content-center {
	-ms-flex-line-pack: center;
	align-content: center
}

.content-between {
	-ms-flex-line-pack: justify;
	align-content: space-between
}

.content-around {
	-ms-flex-line-pack: distribute;
	align-content: space-around
}

.content-stretch {
	-ms-flex-line-pack: stretch;
	align-content: stretch
}

.flex-auto {
	-ms-flex: 1 1 auto;
	flex: 1 1 auto;
	min-width: 0;
	min-height: 0
}

.flex-none {
	-ms-flex: none;
	flex: none
}

.order-0 {
	-ms-flex-order: 0;
	order: 0
}

.order-1 {
	-ms-flex-order: 1;
	order: 1
}

.order-2 {
	-ms-flex-order: 2;
	order: 2
}

.order-3 {
	-ms-flex-order: 3;
	order: 3
}

.order-last {
	-ms-flex-order: 99999;
	order: 99999
}

.relative {
	position: relative
}

.absolute {
	position: absolute
}

.fixed {
	position: fixed
}

.top-0 {
	top: 0
}

.right-0 {
	right: 0
}

.bottom-0 {
	bottom: 0
}

.left-0 {
	left: 0
}

.z1 {
	z-index: 1
}

.z2 {
	z-index: 2
}

.z3 {
	z-index: 3
}

.z4 {
	z-index: 4
}

.border {
	border-style: solid;
	border-width: 1px
}

.border-top {
	border-top-style: solid;
	border-top-width: 1px
}

.border-right {
	border-right-style: solid;
	border-right-width: 1px
}

.border-bottom {
	border-bottom-style: solid;
	border-bottom-width: 1px
}

.border-left {
	border-left-style: solid;
	border-left-width: 1px
}

.border-none {
	border: 0
}

.rounded {
	border-radius: 3px
}

.circle {
	border-radius: 50%
}

.rounded-top {
	border-radius: 3px 3px 0 0
}

.rounded-right {
	border-radius: 0 3px 3px 0
}

.rounded-bottom {
	border-radius: 0 0 3px 3px
}

.rounded-left {
	border-radius: 3px 0 0 3px
}

.not-rounded {
	border-radius: 0
}

.hide {
	position: absolute;
	height: 1px;
	width: 1px;
	overflow: hidden;
	clip: rect(1px, 1px, 1px, 1px)
}

@media (max-width:40rem) {
	.xs-hide {
		display: none
	}

}

@media (min-width:40.06rem) and (max-width:52rem) {
	.sm-hide {
		display: none
	}

}

@media (min-width:52.06rem) and (max-width:64rem) {
	.md-hide {
		display: none
	}

}

@media (min-width:64.06rem) {
	.lg-hide {
		display: none
	}

}

.display-none {
	display: none
}

* {
	box-sizing: border-box
}

body {
	background: #fff;
	color: #000;
	font-family: Cormorant Infant, times, serif;
	min-width: 315px;
	overflow-x: hidden;
	font-smooth: always;
	-webkit-font-smoothing: antialiased
}

main {
	max-width: 700px;
	margin: 0 auto
}

p {
	padding: 0;
	margin: 0
}

.ampstart-accent {
	color: #808992
}

#content:target {
	margin-top: calc(0px - 3.5rem);
	padding-top: 3.5rem
}

.ampstart-title-lg {
	font-size: 2.5rem;
	line-height: 3.5rem;
	letter-spacing: .06rem
}

.ampstart-title-md {
	font-size: 1.625rem;
	line-height: 2.5rem;
	letter-spacing: .06rem
}

.ampstart-title-sm {
	font-size: 1.3125rem;
	line-height: 2.0625;
	letter-spacing: .06rem
}

body {
	line-height: 1.3;
	letter-spacing: normal
}

.ampstart-subtitle {
	color: #808992;
	line-height: 1.6
}

.ampstart-byline, .ampstart-caption, .ampstart-hint, .ampstart-label {
	font-size: 1rem;
	color: #4f4f4f;
	line-height: 1.42857;
	letter-spacing: .06rem
}

.ampstart-label {
	text-transform: uppercase
}

.ampstart-footer, .ampstart-small-text {
	font-size: .9375rem;
	letter-spacing: .06rem
}

.ampstart-card {
	box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .14), 0 1px 1px -1px rgba(0, 0, 0, .14), 0 1px 5px 0 rgba(0, 0, 0, .12)
}

.h1, h1 {
	font-size: 2.5rem;
	line-height: 3.5rem
}

.h2, h2 {
	font-size: 1.625rem;
	line-height: 2.5rem
}

.h3, h3 {
	font-size: 1.3125rem;
	line-height: 2.0625
}

.h4, h4 {
	font-size: 1.125rem;
	line-height: 1.6
}

.h5, h5 {
	font-size: 1rem;
	line-height: 1.42857
}

.h6, h6 {
	font-size: .9375rem;
	line-height: 1.11111
}

h1, h2, h3, h4, h5, h6 {
	margin: 0;
	padding: 0;
	font-weight: 400;
	letter-spacing: .06rem;
	font-family: FoglihtenNo06, times, serif;
}

a, a:active, a:visited {
	color: inherit
}

.ampstart-btn {
	font-family: inherit;
	font-weight: inherit;
	font-size: 1rem;
	line-height: 1.42857;
	padding: .7em .8em;
	text-decoration: none;
	white-space: nowrap;
	word-wrap: normal;
	vertical-align: middle;
	cursor: pointer;
	background-color: #fff;
	color: #021425;
	border: 1px solid #021425
}

.ampstart-btn:visited {
	color: #021425
}

.ampstart-btn-secondary {
	background-color: #000;
	color: #fff;
	border: 1px solid #fff
}

.ampstart-btn-secondary:visited {
	color: #fff
}

.ampstart-btn:active .ampstart-btn:focus {
	opacity: .8
}

.ampstart-btn[disabled], .ampstart-btn[disabled]:active, .ampstart-btn[disabled]:focus, .ampstart-btn[disabled]:hover {
	opacity: .5;
	outline: 0;
	cursor: default
}

.ampstart-dropcap:first-letter {
	color: #fff;
	font-size: 2.5rem;
	font-weight: 700;
	float: left;
	overflow: hidden;
	line-height: 2.5rem;
	margin-left: 0;
	margin-right: .5rem
}

.ampstart-initialcap {
	padding-top: 1rem;
	margin-top: 1.5rem
}

.ampstart-initialcap:first-letter {
	color: #fff;
	font-size: 2.5rem;
	font-weight: 700;
	margin-left: -2px
}

.ampstart-pullquote {
	border: none;
	border-left: 4px solid #fff;
	font-size: 1.3125rem;
	padding-left: 1.5rem
}

.ampstart-byline time {
	font-style: normal;
	white-space: nowrap
}

.amp-carousel-button-next {
	background-image: url('data:image/svg+xml;charset=utf-8,<svg !string!!string!!string!!string!><title>Next</title><path !string!!string!!string!/></svg>')
}

.amp-carousel-button-prev {
	background-image: url('data:image/svg+xml;charset=utf-8,<svg !string!!string!!string!!string!><title>Previous</title><path !string!!string!!string!/></svg>')
}

.ampstart-dropdown {
	min-width: 200px
}

.ampstart-dropdown.absolute {
	z-index: 100
}

.ampstart-dropdown.absolute > section, .ampstart-dropdown.absolute > section > header {
	height: 100%
}

.ampstart-dropdown > section > header {
	background-color: #fff;
	border: 0;
	color: #021425
}

.ampstart-dropdown > section > header:after {
	display: inline-block;
	width="18";
	padding: 0 0 0 1.5rem;
	color: #808992
}

.ampstart-dropdown > [expanded] > header:after {
	height="18"
}

.absolute .ampstart-dropdown-items {
	z-index: 200
}

.ampstart-dropdown-item {
	background-color: #fff;
	color: #808992;
	opacity: .9
}

.ampstart-dropdown-item:active, .ampstart-dropdown-item:hover {
	opacity: 1
}

.ampstart-footer {
	background-color: #fff;
	padding-top: 5rem;
	padding-bottom: 5rem
}

.ampstart-image-fullpage-hero {
	color: #021425
}

.ampstart-fullpage-hero-heading-text, .ampstart-image-fullpage-hero .ampstart-image-credit {
	-webkit-box-decoration-break: clone;
	box-decoration-break: clone;
	background: #fff;
	padding: 0 1rem .2rem
}

.ampstart-image-fullpage-hero > amp-img {
	max-height: calc(100vh - 3.5rem)
}

.ampstart-image-fullpage-hero > amp-img img {
	-o-object-fit: cover;
	object-fit: cover
}

.ampstart-fullpage-hero-heading {
	line-height: 3.5rem
}

.ampstart-fullpage-hero-cta {
	background: transparent
}

.ampstart-readmore {
	background: linear-gradient(0deg, rgba(0, 0, 0, .65) 0, transparent);
	color: #021425;
	margin-top: 5rem;
	padding-bottom: 3.5rem
}

.ampstart-readmore:after {
	display: block;
	viewBox="0 0 34 34";
	font-size: 1.625rem
}

.ampstart-readmore-text {
	background: #fff
}

@media (min-width:52.06rem) {
	.ampstart-image-fullpage-hero > amp-img {
		height: 60vh
	}

}

.ampstart-image-heading {
	color: #021425;
	background: linear-gradient(0deg, rgba(0, 0, 0, .65) 0, transparent)
}

.ampstart-image-heading > * {
	margin: 0
}

amp-carousel .ampstart-image-with-heading {
	margin-bottom: 0
}

.ampstart-image-with-caption figcaption {
	color: #4f4f4f;
	line-height: 1.42857
}

amp-carousel .ampstart-image-with-caption {
	margin-bottom: 0
}

.ampstart-input {
	max-width: 100%;
	width: 300px;
	min-width: 100px;
	font-size: 1rem;
	line-height: 1.6
}

.ampstart-input [disabled], .ampstart-input [disabled] + label {
	opacity: .5
}

.ampstart-input [disabled]:focus {
	outline: 0
}

.ampstart-input > input, .ampstart-input > select, .ampstart-input > textarea {
	width: 100%;
	margin-top: 1.11111;
	line-height: 1.6;
	border: 0;
	border-radius: 0;
	border-bottom: 1px solid #3e6458;
	background: none;
	color: #3e6458;
	outline: 0
}

.ampstart-input > label {
	color: #fff;
	pointer-events: none;
	text-align: left;
	font-size: 1rem;
	line-height: 1.11111;
	opacity: 0;
	animation: .2s;
	animation-timing-function: cubic-bezier(.4, 0, .2, 1);
	animation-fill-mode: forwards
}

.ampstart-input > input:focus, .ampstart-input > select:focus, .ampstart-input > textarea:focus {
	outline: 0
}

.ampstart-input > input:focus:-ms-input-placeholder, .ampstart-input > select:focus:-ms-input-placeholder, .ampstart-input > textarea:focus:-ms-input-placeholder {
	color: transparent
}

.ampstart-input > input:focus::placeholder, .ampstart-input > select:focus::placeholder, .ampstart-input > textarea:focus::placeholder {
	color: transparent
}

.ampstart-input > input:not(:placeholder-shown):not([disabled]) + label, .ampstart-input > select:not(:placeholder-shown):not([disabled]) + label, .ampstart-input > textarea:not(:placeholder-shown):not([disabled]) + label {
	opacity: 1
}

.ampstart-input > input:focus + label, .ampstart-input > select:focus + label, .ampstart-input > textarea:focus + label {
	animation-name: a
}

@keyframes a {
	to {
		opacity: 1
	}

}

.ampstart-input > label:after {
	xmlns="http://www.w3.org/2000/svg";
	height: 2px;
	position: absolute;
	bottom: 0;
	left: 45%;
	background: #3e6458;
	transition: .2s;
	transition-timing-function: cubic-bezier(.4, 0, .2, 1);
	visibility: hidden;
	width: 10px
}

.ampstart-input > input:focus + label:after, .ampstart-input > select:focus + label:after, .ampstart-input > textarea:focus + label:after {
	left: 0;
	width: 100%;
	visibility: visible
}

.ampstart-input > input[type=search] {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none
}

.ampstart-input > input[type=range] {
	border-bottom: 0
}

.ampstart-input > input[type=range] + label:after {
	display: none
}

.ampstart-input > select {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none
}

.ampstart-input > select + label:before {
	d="M25.557 14.7L13.818 2.961 16.8 0l16.8 16.8-16.8 16.8-2.961-2.961L25.557 18.9H0v-4.2z";
	line-height: 1.6;
	position: absolute;
	right: 5px;
	zoom: 2;
	top: 0;
	bottom: 0;
	color: #3e6458
}

.ampstart-input-chk, .ampstart-input-radio {
	width: auto;
	color: #3e6458
}

.ampstart-input input[type=checkbox], .ampstart-input input[type=radio] {
	margin-top: 0;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	width: 20px;
	height: 20px;
	border: 1px solid #3e6458;
	vertical-align: middle;
	margin-right: .5rem;
	text-align: center
}

.ampstart-input input[type=radio] {
	border-radius: 20px
}

.ampstart-input input[type=checkbox]:not([disabled]) + label, .ampstart-input input[type=radio]:not([disabled]) + label {
	pointer-events: auto;
	animation: none;
	vertical-align: middle;
	opacity: 1;
	cursor: pointer
}

.ampstart-input input[type=checkbox] + label:after, .ampstart-input input[type=radio] + label:after {
	display: none
}

.ampstart-input input[type=checkbox]:after, .ampstart-input input[type=radio]:after {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	fill="%23FFF";
	line-height: 1.4rem;
	vertical-align: middle;
	text-align: center;
	background-color: #fff
}

.ampstart-input input[type=checkbox]:checked:after {
	background-color: #3e6458;
	color: #3e6458;
	fill-rule="evenodd"
}

.ampstart-input input[type=radio]:checked {
	background-color: #fff
}

.ampstart-input input[type=radio]:after {
	top: 3px;
	bottom: 3px;
	left: 3px;
	right: 3px;
	border-radius: 12px
}

.ampstart-input input[type=radio]:checked:after {
	width="18";
	font-size: 2.5rem;
	background-color: #fff
}

.ampstart-input > label, _:-ms-lang(x) {
	opacity: 1
}

.ampstart-input > input:-ms-input-placeholder, _:-ms-lang(x) {
	color: transparent
}

.ampstart-input > input::placeholder, _:-ms-lang(x) {
	color: transparent
}

.ampstart-input > input::-ms-input-placeholder, _:-ms-lang(x) {
	color: transparent
}

.ampstart-input > select::-ms-expand {
	display: none
}

.ampstart-headerbar {
	background-color: #fff;
	z-index: 999;
	box-shadow: 0 0 5px 2px rgba(0, 0, 0, .1)
}

.ampstart-headerbar +:not(amp-sidebar), .ampstart-headerbar + amp-sidebar + * {
	margin-top: 3.5rem
}

.ampstart-headerbar-nav .ampstart-nav-item {
	padding: 0 1rem;
	background: transparent;
	opacity: .8
}

.ampstart-headerbar-nav {
	line-height: 3.5rem
}

.ampstart-nav-item:active, .ampstart-nav-item:focus, .ampstart-nav-item:hover {
	opacity: 1
}

.ampstart-navbar-trigger:focus {
	outline: none
}

.ampstart-nav a, .ampstart-navbar-trigger, .ampstart-sidebar-faq a {
	cursor: pointer;
	text-decoration: none
}

.ampstart-nav .ampstart-label {
	color: inherit
}

.ampstart-navbar-trigger {
	line-height: 3.5rem;
	font-size: 1.625rem
}

.ampstart-headerbar-nav {
	-ms-flex: 1;
	flex: 1
}

.ampstart-nav-search {
	-ms-flex-positive: 0.5;
	flex-grow: 0.5
}

.ampstart-headerbar .ampstart-nav-search:active, .ampstart-headerbar .ampstart-nav-search:focus, .ampstart-headerbar .ampstart-nav-search:hover {
	box-shadow: none
}

.ampstart-nav-search > input {
	border: none;
	border-radius: 3px;
	line-height: normal
}

.ampstart-nav-dropdown {
	min-width: 200px
}

.ampstart-nav-dropdown amp-accordion header {
	background-color: #fff;
	border: none
}

.ampstart-nav-dropdown amp-accordion ul {
	background-color: #fff
}

.ampstart-nav-dropdown .ampstart-dropdown-item, .ampstart-nav-dropdown .ampstart-dropdown > section > header {
	background-color: #fff;
	color: #021425
}

.ampstart-nav-dropdown .ampstart-dropdown-item {
	color: #808992
}

.ampstart-sidebar {
	background-color: #fff;
	color: #021425;
	min-width: 300px;
	width: 300px
}

.ampstart-sidebar .ampstart-icon {
	fill: #808992
}

.ampstart-sidebar-header {
	line-height: 3.5rem;
	min-height: 3.5rem
}

.ampstart-sidebar .ampstart-dropdown-item, .ampstart-sidebar .ampstart-dropdown header, .ampstart-sidebar .ampstart-faq-item, .ampstart-sidebar .ampstart-nav-item, .ampstart-sidebar .ampstart-social-follow {
	margin: 0 0 2.5rem
}

.ampstart-sidebar .ampstart-nav-dropdown {
	margin: 0
}

.ampstart-sidebar .ampstart-navbar-trigger {
	line-height: inherit
}

.ampstart-navbar-trigger svg {
	pointer-events: none
}

.ampstart-related-article-section {
	border-color: #fff
}

.ampstart-related-article-section .ampstart-heading {
	color: #000;
	font-weight: 400
}

.ampstart-related-article-readmore {
	color: #fff;
	letter-spacing: 0
}

.ampstart-related-section-items > li {
	border-bottom: 1px solid #fff
}

.ampstart-related-section-items > li:last-child {
	border: none
}

.ampstart-related-section-items .ampstart-image-with-caption {
	display: -ms-flexbox;
	display: flex;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	-ms-flex-align: center;
	align-items: center;
	margin-bottom: 0
}

.ampstart-related-section-items .ampstart-image-with-caption > amp-img, .ampstart-related-section-items .ampstart-image-with-caption > figcaption {
	-ms-flex: 1;
	flex: 1
}

.ampstart-related-section-items .ampstart-image-with-caption > figcaption {
	padding-left: 1rem
}

@media (min-width:40.06rem) {
	.ampstart-related-section-items > li {
		border: none
	}

	.ampstart-related-section-items .ampstart-image-with-caption > figcaption {
		padding: 1rem 0
	}

	.ampstart-related-section-items .ampstart-image-with-caption > amp-img, .ampstart-related-section-items .ampstart-image-with-caption > figcaption {
		-ms-flex-preferred-size: 100%;
		flex-basis: 100%
	}

}

.ampstart-social-box {
	display: -ms-flexbox;
	display: flex
}

.ampstart-social-box > amp-social-share {
	background-color: #fff
}

.ampstart-icon {
	fill: #808992
}

.h1, .h2, h1, h2 {
	letter-spacing: 0
}

.h3, h3 {
	color: #021425;
	font-family: FoglihtenNo06, arial, sans-serif;
	letter-spacing: .6px
}

.h4, h4 {
	letter-spacing: .2px;
	line-height: 1.42857
}

.ampstart-title-lg {
	font-size: 2.8125rem;
	line-height: 1.11111;
	letter-spacing: normal
}

.ampstart-title-md {
	font-size: 2.5rem;
	line-height: 2.0625;
	letter-spacing: normal
}

.ampstart-title-sm {
	font-size: 1.125rem;
	line-height: 1.11111;
	letter-spacing: .2px
}

.ampstart-subtitle {
	color: #021425;
	font-size: 1rem;
	line-height: 1.11111;
	letter-spacing: normal
}

.ampstart-byline {
	font-size: .9375rem;
	font-style: italic;
	letter-spacing: normal;
	color: #808992;
	opacity: .8
}

.ampstart-caption {
	font: 400 .9375rem/1.42857 FoglihtenNo06, times, serif;
	letter-spacing: normal
}

.land-see-page-navigation, .land-see-page-navigation button, .land-see-page-navigation h3 {
	font: 400 .8125rem/2.0625 Inconsolata, verdana, sans-serif
}

.land-see-section-header {
	font: 600 .8125rem/1.6 Inconsolata, verdana, sans-serif;
	color: #021425;
	letter-spacing: 1px;
	text-transform: uppercase
}

.ampstart-headerbar {
	background: #fff;
	color: #021425;
	padding-right: 1rem
}

.ampstart-headerbar-nav {
	-ms-flex: none;
	flex: none
}

@media (min-width:52.06rem) {
	.ampstart-headerbar-nav {
		-ms-flex: 1;
		flex: 1
	}

	.ampstart-headerbar-fixed-link {
		margin-right: 1rem
	}

}

.ampstart-headerbar-nav > ul {
	text-align: right;
	float: right
}

.ampstart-headerbar-title {
	font: 600 1.125rem/1.6 Montserrat, arial, sans-serif
}

.ampstart-navbar-trigger {
	font-size: 1.5rem
}

.ampstart-headerbar-fixed-link {
	margin-right: 0
}

.ampstart-sidebar .ampstart-nav-dropdown section header {
	height: 0;
	width: 0;
	margin: 0
}

.ampstart-headerbar .ampstart-nav-dropdown {
	display: none
}

.ampstart-nav-item {
	font-family: Inconsolata, verdana, sans-serif;
	text-transform: uppercase;
	letter-spacing: .1rem
}

.land-see-sidebar-nav-item {
	font-family: Montserrat, arial, sans-serif;
	color: #021425;
	text-transform: capitalize;
	letter-spacing: .6px;
	line-height: 2.0625
}

.ampstart-dropdown-item {
	font: 400 .9375rem/2.5rem Inconsolata, verdana, sans-serif;
	text-transform: uppercase;
	letter-spacing: normal
}

.ampstart-sidebar .ampstart-dropdown-item {
	margin-bottom: 0
}

.ampstart-nav-dropdown {
	padding-bottom: .75rem
}

.ampstart-nav-dropdown .ampstart-dropdown-item, .ampstart-nav-dropdown amp-accordion ul, .ampstart-sidebar {
	background-color: #fef4f2
}

.ampstart-sidebar-nav > ul > li:first-child {
	margin-bottom: 0
}

.ampstart-dropdown-items > li:last-child {
	margin-bottom: 1rem
}

.ampstart-label {
	line-height: 2.0625
}

.ampstart-sidebar .ampstart-dropdown-items:after {
	height="18";
	display: inline-block;
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	height: 1px;
	background: #efe5e3
}

.ampstart-sidebar .ampstart-sidebar-nav:after {
	viewBox="0 0 34 34";
	height: 100px;
	width: 100%;
	position: absolute;
	left: 0;
	background: url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!%3E%3Cpath !string!!string!!string!!string!/%3E%3C/svg%3E") repeat-x 0 61px
}

.ampstart-sidebar .ampstart-icon, .land-see-story-nav .ampstart-icon {
	color: #021425;
	fill: #021425
}

.ampstart-sidebar .ampstart-social-follow, .ampstart-social-follow {
	margin: 0
}

.ampstart-social-follow > li {
	margin-right: 0
}

.ampstart-sidebar .ampstart-nav-item {
	margin: 0 0 .5rem
}

.ampstart-sidebar .ampstart-faq-item {
	margin-bottom: 1.5rem
}

.ampstart-footer {
	font-family: Inconsolata, verdana, sans-serif;
	color: #3e6458;
	padding-top: 1rem;
	padding-bottom: 1.5rem;
	background-color: transparent
}

.ampstart-footer .ampstart-icon {
	fill: #3e6458
}

.ampstart-footer .ampstart-social-follow li:last-child {
	margin-right: 0
}

.ampstart-footer-nav ul {
	margin-top: 0;
	margin-bottom: .688rem;
	display: none
}

.ampstart-footer-nav ul li {
	padding: 0 1rem 0 0
}

.ampstart-footer small {
	margin-bottom: 1.625rem;
	letter-spacing: .1rem;
	font-size: .8125rem;
	text-transform: uppercase
}

.ampstart-footer .ampstart-label {
	font-size: .9375rem;
	text-transform: capitalize
}

.ampstart-footer .ampstart-social-follow {
	-ms-flex-order: 2;
	order: 2;
	-ms-flex-pack: end;
	justify-content: flex-end
}

.ampstart-footer, .ampstart-small-text {
	line-height: 1.11111
}

@media (max-width:40rem) {
	.ampstart-footer small {
		font-size: .688rem
	}

}

@media (min-width:64.06rem) {
	.ampstart-footer {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		-ms-flex-direction: row;
		flex-direction: row
	}

	.ampstart-footer-nav {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-preferred-size: 50%;
		flex-basis: 50%;
		-ms-flex-order: 1;
		order: 1
	}

	.ampstart-footer-nav ul {
		display: -ms-inline-flexbox;
		display: inline-flex
	}

	.ampstart-footer small {
		margin-bottom: .75rem;
		-ms-flex-order: 3;
		order: 3
	}

	.ampstart-footer .ampstart-social-follow {
		-ms-flex-preferred-size: 50%;
		flex-basis: 50%;
		-ms-flex-pack: end;
		justify-content: flex-end
	}

}

.land-see-subscribe {
	position: relative;
	height: 310px;
	overflow: hidden;
	color: #3e6458
}

.land-see-subscribe amp-img {
	position: absolute;
	width: 100%;
	-o-object-position: top center;
	object-position: top center
}

.land-see amp-img.cover img {
	-o-object-fit: cover;
	object-fit: cover
}

.land-see-subscribe-form {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%)
}

.land-see-subscribe-form form {
	padding: 0
}

.land-see-subscribe-form h2 {
	margin-bottom: 1.3125rem;
	padding-top: 2.5rem
}

.land-see-subs-heading-text {
	font-size: 1.625rem;
	position: relative
}

.land-see-subscribe-form .ampstart-input {
	margin-bottom: 0
}

.land-see-subscribe-form .ampstart-input > label {
	display: none
}

.land-see-subscribe-form input:not([type=checkbox]):not([type=radio]) {
	-webkit-appearance: none
}

.land-see-subscribe-form input[type=email] {
	font: 600 .8125rem/2.0625 Inconsolata, verdana, sans-serif;
	letter-spacing: .6px;
	border: 2px solid #fff;
	padding: 2px 0 0 .688rem
}

.land-see-subscribe-form input[type=submit] {
	width: 10px;
	height: 13px;
	line-height: 0;
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!%3E%3Cpath !string!!string!/%3E%3C/svg%3E");
	border: none;
	position: absolute;
	top: -41px;
	right: 10px;
	cursor: pointer;
	z-index: 10
}

.land-see-subscribe-form input[type=email].user-invalid {
	border: 2px solid red
}

.land-see-stories {
	margin-bottom: 10px;
	position: relative;
	overflow: hidden
}

.land-see-stories > h3 {
	text-transform: uppercase;
	font-weight: 700;
	min-height: 68px;
	line-height: 68px;
	outline: none
}

.land-see-stories > h3:after {
	xmlns="http://www.w3.org/2000/svg";
	position: absolute;
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!%3E%3Cpath !string!!string!!string!!string!!string!/%3E%3C/svg%3E");
	height: 14px;
	width: 14px;
	right: 30px;
	top: 28px;
	cursor: pointer
}

.land-see-stories[expanded] > h3:after {
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!%3E%3Cpath !string!!string!!string!!string!!string!/%3E%3C/svg%3E")
}

.land-see-stories:before {
	d="M33.6 14.7H8.043L19.782 2.961 16.8 0 0 16.8l16.8 16.8 2.961-2.961L8.043 18.9H33.6z";
	position: absolute;
	height: 168px;
	left: 0;
	right: 0;
	background-color: #fddcd7
}

.land-see-stories > h3 {
	cursor: default;
	background-color: inherit;
	padding-right: 0;
	border: none
}

.land-see-arts-culture:before {
	opacity: .3
}

.land-see-design:before {
	opacity: .54
}

.land-see-fashion:before {
	opacity: .77
}

.land-see-interiors:before {
	opacity: 1
}

.land-see-post-item {
	max-width: 196px;
	text-align: left
}

.land-see-pre-animate {
	opacity: 0;
	transform: translateY(-10px)
}

.land-see-post-item-wide {
	max-width: 100%;
	text-align: left
}

.land-see-post-featured {
	width: 100%
}

@media (min-width:30.06rem) {
	.land-see-post-featured {
		width: 50%
	}

	.land-see-post-video p {
		margin-bottom: 5rem
	}

}

.land-see-post-title {
	font-weight: 700
}

.land-see a.land-see-post-category {
	color: #808992;
	letter-spacing: 1.4px
}

.land-see-post-item h4 {
	font-family: FoglihtenNo06, arial, sans-serif;
	color: #021425
}

.land-see-post-item h4 a:hover {
	opacity: .77
}

.land-see-cta-link {
	display: block;
	max-width: 813px
}

@media (min-width:52.06rem) {
	.land-see-cta-link {
		margin-top: 3.5rem;
		margin-bottom: 3.5rem
	}

}

.land-see-background-animation {
	top: calc(-80px + 3.5rem);
	left: 0;
	right: 0;
	height: 500px;
	min-height: 500px;
	z-index: -1
}

.land-see-stories-anim-container .land-see-background-animation {
	top: 435px
}

.land-see-background-animation svg {
	width: 100%;
	height: 100%
}

.land-see-background-image-left {
	top: 0;
	left: -36%;
	opacity: .2;
	width: 327px;
	height: 261px
}

.land-see-background-image-right {
	top: 0;
	right: -44%;
	opacity: .3;
	width: 313px;
	height: 250px
}

@media (min-width:40.06rem) {
	.land-see-background-animation {
		top: calc(-260px + 3.5rem)
	}

	.land-see-background-image-left {
		width: 690px;
		height: 551px
	}

	.land-see-background-image-right {
		top: 196px;
		width: 491px;
		height: 392px
	}

}

.land-see-paging, .land-see-popular-content, .land-see-recent-content, .land-see-story-nav {
	max-width: 850px
}

.land-see-recent-content ul li:first-child {
	margin-top: 0
}

.land-see .amp-carousel-button {
	height: 40px;
	width: 40px;
	outline: none;
	cursor: pointer;
	background: transparent url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!!string!%3E%3Cpath !string!!string!!string!!string!/%3E%3C/svg%3E") no-repeat 50%
}

.land-see-popular-content .amp-carousel-button {
	top: 97px;
	background-size: 35%
}

.land-see .amp-carousel-button-prev {
	transform-origin: center center;
	transform: rotate(180deg) translateY(50%)
}

.land-see-recent-accent-image {
	left: -5px;
	bottom: 25%;
	width: 44px;
	height: 35px
}

@media (min-width:40.06rem) and (max-width:52rem) {
	.land-see-popular-content {
		max-width: 636px
	}

}

@media (max-width:40rem) {
	.land-see-popular-content {
		max-width: 424px
	}

}

.land-see-hero-container {
	max-width: 1600px
}

.land-see-hero-carousel {
	max-width: 1290px
}

.land-see-hero-button, .land-see-hero-caption, .land-see-hero-title {
	color: #fff
}

.land-see-hero-content amp-img:before {
	fill="%23FFF";
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background: linear-gradient(180deg, hsla(120, 0%, 49%, 0) 0, hsla(120, 0%, 49%, .15) 30%, hsla(0, 0%, 5%, .6));
	z-index: 1
}

.land-see-hero-image {
	background-color: #7d7e7d
}

.land-see-cover-position-top img {
	-o-object-position: top center;
	object-position: top center
}

.land-see-cover-position-bottom img {
	-o-object-position: bottom center;
	object-position: bottom center
}

.land-see-hero-typography {
	bottom: -4%;
	left: 50%;
	transform: translate(-50%, -50%)
}

.land-see-hero-title {
	line-height: 1.11111;
	font-family: FoglihtenNo06, times, serif
}

.land-see-hero-caption {
	font-size: 1rem;
	line-height: 1.11111;
	opacity: .85
}

.land-see-hero-button {
	font: 400 1rem/1.11111 Inconsolata, verdana, sans-serif;
	text-transform: uppercase;
	padding: 13px 20px;
	border: 1px solid #fff;
	opacity: .85;
	cursor: pointer
}

.land-see-hero-button:hover {
	opacity: .75
}

.land-see-hero-button:active {
	top: 1px
}

.land-see-hero-button:visited {
	color: #fff
}

.land-see-hero-left:before, .land-see-hero-right:before {
	fill-rule="evenodd";
	position: absolute;
	top: 0;
	height: 680px;
	width: 131px;
	z-index: 4
}

.land-see-hero-left:before {
	right: 0;
	background: linear-gradient(270deg, hsla(0, 0%, 100%, 0) 0, #fff)
}

.land-see-hero-right:before {
	background: linear-gradient(90deg, hsla(0, 0%, 100%, 0) 0, #fff)
}

#land-see-hero-left .amp-carousel-button, #land-see-hero-right .amp-carousel-button {
	display: none
}

.land-see-hero-left {
	top: 0;
	right: 1470px;
	width: 1290px;
	height: 680px
}

.land-see-hero-right {
	top: 0;
	left: 1470px;
	width: 1290px;
	height: 680px
}

.land-see-gallery-progress button, .land-see-hero-progress button {
	border: none;
	background: transparent;
	cursor: pointer;
	outline: none
}

.land-see-progress-indicator {
	opacity: .4
}

.land-see-selected-slide {
	opacity: 1
}

@media (max-width:100rem) {
	.land-see-hero-left, .land-see-hero-right {
		display: none
	}

}

@media (max-width:40rem) {
	.land-see-hero-button, .land-see-hero-caption, .land-see-hero-title {
		color: #021425
	}

	.land-see-hero-title {
		font-weight: 600;
		font-size: 2.8125rem
	}

	.land-see-hero-caption {
		width: auto
	}

	.land-see-hero-button {
		border-color: #021425
	}

	.land-see-hero-button:visited {
		color: #021425
	}

	.land-see .land-see-hero-container .amp-carousel-button {
		top: 24%
	}

	.land-see-hero-typography {
		max-width: 300px;
		margin-top: 32px;
		bottom: auto;
		left: auto;
		transform: none
	}

	.land-see-hero-progress {
		position: absolute;
		top: 266px;
		left: 50%;
		transform: translate(-50%)
	}

}

.land-see-category h1 {
	font-family: FoglihtenNo06, times, serif;
	color: #021425
}

.land-see-categories-nav, .land-see-categories-nav-page-load {
	overflow: hidden;
	height: 35px;
	border-bottom: 1px solid #f0f0f0
}

.land-see-categories-carousel > div:first-child {
	padding-bottom: 50px
}

.land-see-categories-carousel .amp-carousel-button {
	content: "+";
	background: linear-gradient(90deg, hsla(0, 0%, 100%, 0), #fff);
	position: absolute;
	top: 0;
	right: 0;
	width: 150px;
	height: 70px
}

.land-see-categories-carousel .amp-carousel-button-prev {
	left: 0
}

.land-see-categories-button {
	font: 500 .9375rem/1.11111 Inconsolata, verdana, sans-serif;
	text-transform: uppercase;
	letter-spacing: .1rem;
	border: none;
	outline: none;
	background-color: transparent;
	padding: 0 0 3px;
	cursor: pointer
}

.land-see-categories-button:focus, .land-see-next-page:focus, .land-see-prev-page:focus {
	outline: 0
}

.land-see-categories-nav-page-load button:target, .land-see-selected-category {
	border-bottom: 1px solid #98caaf;
	border-radius: 0
}

.land-see-paging {
	border-top: 1px solid #f0f0f0
}

.land-see-next-page, .land-see-prev-page {
	color: #808992;
	letter-spacing: 1.4px;
	border: none;
	text-transform: uppercase;
	text-decoration: underline;
	background-color: transparent;
	padding: 0 0 3px;
	cursor: pointer
}

.land-see-next-page:after, .land-see-prev-page:before {
	content: "–";
	background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg !string!!string!!string!!string!%3E%3Cpath !string!!string!/%3E%3C/svg%3E");
	position: absolute;
	top: 8px;
	right: -16px;
	width: 8px;
	height: 12px;
	z-index: 1
}

.land-see-prev-page:before {
	transform-origin: center center;
	transform: rotate(180deg) translateY(50%);
	left: -16px;
	top: 14px
}

.land-see-list-overflow[overflow] {
	background: linear-gradient(0deg, #fff 0, hsla(0, 0%, 100%, .7) 50%, hsla(0, 0%, 100%, 0));
	cursor: pointer;
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	padding: 7px 0 5px;
	z-index: 2
}

.land-see-overflow-button {
	font-size: .8125rem;
	color: #021425;
	border-color: transparent;
	opacity: 1
}

@media (max-width:40rem) {
	.land-see-categories-carousel .amp-carousel-button {
		width: 60px
	}

}

@media (max-width:30rem) {
	.land-see-hide-mobile {
		display: none
	}

}

@media (min-width:30.06rem) {
	.land-see-hide-widescreen {
		display: none
	}

	.land-see-recent-content ul li:nth-child(2) {
		margin-top: 0
	}

}

.land-see-story-detail .land-see-post-item-wide {
	text-align: center
}

.ampstart-sidebar .ampstart-nav-dropdown .ampstart-dropdown-item, .land-see-blockquote p, .land-see-story-detail .land-see-hero-caption, .land-see-story-detail .land-see-hero-title {
	color: #021425
}

.land-see-story-detail .land-see-hero-caption {
	width: auto
}

.land-see-story-subtitle {
	font-family: Montserrat, arial, sans-serif;
	font-weight: 600;
	margin-bottom: -.5rem
}

.land-see-story-copy b {
	line-height: normal
}

.land-see-blockquote:before {
	content: "⌄";
	background: url(../img/land-see/structure/green-up-full-20.svg) 0 0/198px 156px no-repeat;
	position: absolute;
	top: 50%;
	left: 1rem;
	width: 198px;
	height: 157px;
	transform: rotate(90deg) translate(-40%);
	opacity: .2;
	z-index: -1
}

.land-see-blockquote p {
	font-size: 1.625rem;
	line-height: 1.42857
}

.land-see-blockquote cite {
	font-family: Inconsolata, verdana, sans-serif;
	font-size: .688rem;
	font-style: normal;
	text-transform: uppercase;
	color: #808992
}

.land-see-image-gallery {
	max-width: 813px;
	margin-top: 3.5rem;
	margin-bottom: 3.5rem
}

.land-see-gallery-progress {
	height: 58px
}

.land-see-gallery-progress-scroll {
	overflow-x: scroll;
	padding-bottom: 58px
}

.land-see-gallery-progress button {
	padding-right: 3px;
	outline: none;
	background: transparent
}

.land-see-gallery-progress button:last-child {
	padding-right: 0
}

.land-see-selected-preview-image {
	opacity: .77
}

.land-see-instagram-post {
	margin-top: -67px;
	max-width: 196px
}

.land-see-instagram > h3 span {
	margin-left: 40px
}

.land-see-instagram > h3 span:before {
	content: "";
	position: absolute;
	background: url(../img/icons/instagram.svg) -5px -3px/35px 35px no-repeat;
	height: 29px;
	width: 29px;
	top: 0;
	left: -40px;
	z-index: 3
}

.land-see-story-instagram-container.land-see-stories > h3:after {
	content: "⌄";
	background: none;
	height: 0;
	width: 0
}

.land-see-story-social-share-heading {
	float: left;
	color: #808992;
	text-transform: uppercase;
	padding-top: .5rem
}

.land-see-story-nav .ampstart-social-follow {
	float: right;
	-ms-flex-pack: start;
	justify-content: flex-start
}

@media (max-width:30rem) {
	.land-see-story-detail .land-see-post-item .land-see-image-attribution {
		display: none
	}

	.land-see-blockquote p, .land-see-image-attribution, .land-see-story-copy, .land-see-story-subtitle {
		padding-left: 1rem
	}

	.land-see-flying-carpet {
		display: block
	}

	.land-see-story-subtitle {
		padding-top: 1rem
	}

	.land-see-story-copy {
		padding-right: 1rem
	}

	.land-see-blockquote:before {
		left: -22px
	}

	.land-see-blockquote {
		padding: 1rem
	}

}

@media (max-width:25rem) {
	.land-see-story-instagram-container {
		margin-bottom: 0
	}

}

@media (max-width:40rem) {
	.land-see-story-social {
		-ms-flex-order: 3;
		order: 3
	}

}

@font-face {
	font-family: 'Cormorant Infant';
	src: local('Cormorant Infant'), local('CormorantInfant-Regular'), url(/fonts/comorantinfant/Cormorantinfant.woff2) format('woff2'),
     url(/fonts/comorantinfant/Cormorantinfant.woff) format('woff'), url(/fonts/comorantinfant/Cormorantinfant.ttf) format('truetype');
	font-weight: 400;
	font-style: normal
}

@font-face {
	font-family: 'Forum';
	src: local('Forum'), url(/fonts/forum/forum.woff2) format('woff2'), url(/fonts/forum/forum.woff) format('woff'), url(/fonts/forum/forum.ttf) format('truetype');
	font-weight: 400;
	font-style: normal
}

@font-face {
	font-family: 'Noto Serif';
	src: local('Noto Serif'), local('NotoSerif'), url(/fonts/notoserif/notoserif.woff2) format('woff2'), url(/fonts/notoserif/notoserif.woff) format('woff'), url(/fonts/notoserif/notoserif.ttf) format('truetype');
	font-weight: 400;
	font-style: normal
}

@font-face {
	font-family: 'FoglihtenNo06';
	src: local('FoglihtenNo06'), url(/fonts/foglihtenno06/foglihtenno06.woff2) format('woff2'), url(/fonts/foglihtenno06/foglihtenno06.woff) format('woff'), url(/fonts/foglihtenno06/foglihtenno06.ttf) format('truetype');
	font-weight: 400;
	font-style: normal
}

body.index {
	background-position-x: 50%;
	background-image: url(/files/winter-bg.jpg);
	background-size: cover;
}

body {
	background-image: url('img/background2.jpg');
	background-size: auto;
	background-position-x: unset;
}

a {
	text-decoration: none;
}

.alpha-60 {
	opacity: 0.6;
	filter: alpha(opacity=60);
}

.alpha-70 {
	opacity: 0.7;
	filter: alpha(opacity=70);
}

.alpha-80 {
	opacity: 0.8;
	filter: alpha(opacity=80);
}

.alpha-90 {
	opacity: 0.9;
	filter: alpha(opacity=90);
}

.bg-sky {
	background-color: #bbdbe6;
}

.bg-white {
	background-color: #fff;
}

.bg-white-a60 {
	background-color: rgba(255, 255, 255, 0.6);
}

.bg-white-a70 {
	background-color: rgba(255, 255, 255, 0.7);
}

.border-grey {
	border-color: grey;
}

.thumb-wrap-150px {
	width: 150px;
	height: 150px;
	overflow: hidden;
}

@media only screen and (max-width:480px) {
	.thumb-wrap-150px {
		width: 75px;
		height: 75px;
	}

	.head-menu li:first-child {
		display: block;
	}

	.no-margins {
		margin-left: -1rem;
		margin-right: -1rem;
	}

	.lightbox-wrap {
		padding-top: 50%;
	}

	body.index {
		background-color: #004571;
		background-size: auto;
		background-position-x: unset;
	}

	.h1, h1 {
		line-height: 1.75rem;
		//font-size: 1.45rem;
	}

	.h2, h2 {
		line-height: 1.75rem;
		//font-size: 1.3rem;
	}

}

.h3, h3 {
	line-height: 1.6rem;
}

@media only screen and (min-width:481px) {
	.lightbox-wrap {
		padding-top: 5vh;
	}

}

.footer-wrap .footer-menu {
	width: 100%;
	top: 50%;
	z-index: 9999;
	color: white;
}

.bg-video-wrap {
	width: 100%;
	height: 100%;
}

@media only screen and (max-width:1200px) {
	.bg-video-wrap {
		margin-left: calc((165vh - 93vw)/2 * -1);
	}

}

.bg-video-wrap-mob {
	min-width: 100%;
	min-height: 100%;
}

.video-wrap {
	min-width: 177vh;
	min-height: 100vh;
}

.video-wrap-mob {
	min-width: 0.58vh;
	min-height: 100vh;
}

.amp-carousel-slide {
	opacity: 0;
}

.amp-carousel-slide[aria-hidden=false] {
	transition: opacity 1s;
	opacity: 1;
}

.land-see-hero-image {
	background-color: #fff;
}

.land-see-hero-image img {
	opacity: 0.9;
}

.thumb-wrap {
	width: 100px;
	height: 75px;
	overflow: hidden;
}

.thumb-wrap-75px {
	width: 75px;
	height: 75px;
	overflow: hidden;
}

.amp-lightbox > div {
	background-color: #000;
}

.close-btn {
	background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/PjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+PHN2ZyB2aWV3Qm94PSIwIDAgNDAgNDAiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PGRlZnMgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGh0bWwiPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbCi5ib3ggeyBtYXJnaW46IDIwcHg7IGJhY2tncm91bmQ6IHJnYigyMjEsIDIyMSwgMjIxKTsgZmxvYXQ6IGxlZnQ7IGJvcmRlci1yYWRpdXM6IDUwJTsgfQouYm94MSB7IHdpZHRoOiAyMDBweDsgfQouYm94MiB7IHdpZHRoOiAxMDBweDsgfQouYm94MyB7IHdpZHRoOiAyMHB4OyB9CnN2ZyB7IGRpc3BsYXk6IGJsb2NrOyB9Ci5jbG9zZS14IHsgc3Ryb2tlOiBibGFjazsgZmlsbDogdHJhbnNwYXJlbnQ7IHN0cm9rZS1saW5lY2FwOiByb3VuZDsgc3Ryb2tlLXdpZHRoOiA1OyB9CmJ1dHRvbiB7IHdpZHRoOiAxMDBweDsgaGVpZ2h0OiAxMDBweDsgcGFkZGluZzogMHB4OyB9XV0+PC9zdHlsZT48L2RlZnM+CjxwYXRoIGNsYXNzPSJjbG9zZS14IiBkPSJNIDEwLDEwIEwgMzAsMzAgTSAzMCwxMCBMIDEwLDMwIi8+Cjwvc3ZnPg==");
	width: 25px;
	height: 25px;
	line-height: 21px;
	text-align: center;
	border: 1px solid grey;
	right: 20px;
	top: 20px;
}

.custom-bullets {
	list-style-image: url(/files/bullet-point.png);
}

.arrow-down {
	margin-top: 4px;
	width: 0;
	height: 0;
	border-left: 20px solid transparent;
	border-right: 20px solid transparent;
	border-top: 20px solid #f00;
}

.chevron::before {
	border-style: solid;
	border-width: 0.25em 0.25em 0 0;
	content: " ";
	display: inline-block;
	height: 0.45em;
	left: 0.15em;
	position: relative;
	top: 0.15em;
	transform: rotate(-45deg);
	vertical-align: top;
	width: 0.45em;
}

.chevron.bottom:before {
	top: 0.4rem;
	transform: rotate(135deg);
}

.content-wrap {
	min-height: 650px;
}

.pagination {
	display: inline-block;
	padding-left: 0;
	margin: 16px;
	border-radius: 4px;
	list-style-type: disc;
}

.pagination > li > a, .pagination > li > span {
	position: relative;
	float: left;
	padding: 6px 12px;
	line-height: 1.42857143;
	text-decoration: none;
	border: 1px solid #ddd;
}

.pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
	color: #777;
	cursor: not-allowed;
	background-color: #fff;
	border-color: #ddd;
}

.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
	z-index: 2;
	background-color: #c1c1c1;
	border-color: #ddd;
}

.pagination > li:first-child > a, .pagination > li:first-child > span {
	margin-left: 0;
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
}

.pagination > li:first-child > span {
	margin-left: 0;
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
}

.pagination > li:last-child > a, .pagination > li:last-child > span {
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
}

.pagination > li {
	display: inline;
	text-align: -webkit-match-parent;
}

.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
	background-color: #86add3;
	border-color: #86add3;
	color: #FFF;
}

.media-label {
	bottom: 0px;
}

ul.breadcrumbs li:after {
	content: "✓";
	display: inline-block;
	width: 30px;
	height: 10px;
	margin-left: 5px;
	margin-right: 5px;
	background: url(/files/arrow.svg) no-repeat center;
}

ul.breadcrumbs li:last-child:after {
	background: none;
}

.alert-primary {
	color: #004085;
	background-color: #cce5ff;
	border-color: #b8daff;
}

.alert-success {
	color: #155724;
	background-color: #d4edda;
	border-color: #c3e6cb;
}

.alert-danger {
	color: #721c24;
	background-color: #f8d7da;
	border-color: #f5c6cb;
}

.alert-dark {
	color: #1b1e21;
	background-color: #d6d8d9;
	border-color: #c6c8ca;
}

.alert {
	position: relative;
	padding: .75rem 1.25rem;
	margin-bottom: 1rem;
	border: 1px solid transparent;
	border-radius: .25rem;
}

.logo-wrap {
	background-image: url(/664x350/files/logo-color.png);
	height: 210px;
	background-repeat: no-repeat;
	background-size: 100%;
}

.logo-wrap-md {
	z-index: 9999;
	right: 100px;
	top: -70px;
	width: 300px;
}

.logo-wrap-mob {
	width: 100%;
	background-position: 50% 50%;
}

.desk-logo-wrap {
	max-width: 650px;
}

.social-icons-wrap i {
	color: #84b0dd;
}

.text-center {
	text-align: center;
}

.max-width-200px {
	max-width: 200px;
}

.block-center {
	margin-left: auto;
	margin-right: auto;
}

</style>

<style amp-boilerplate="">
    body {
	-webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
	-moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
	-ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
	animation: -amp-start 8s steps(1, end) 0s 1 normal both
}

@-webkit-keyframes -amp-start {
	from {
		visibility: hidden
	}

	to {
		visibility: visible
	}

}

@-moz-keyframes -amp-start {
	from {
		visibility: hidden
	}

	to {
		visibility: visible
	}

}

@-ms-keyframes -amp-start {
	from {
		visibility: hidden
	}

	to {
		visibility: visible
	}

}

@-o-keyframes -amp-start {
	from {
		visibility: hidden
	}

	to {
		visibility: visible
	}

}

@keyframes -amp-start {
	from {
		visibility: hidden
	}

	to {
		visibility: visible
	}

}
    </style>
	<?php
    return ob_get_clean(); // Возвращаем буферизированный вывод
	}
	?>