<?php
/**
* Initialze default setup when we process file.
*/
	class ShopAuthComponent extends Component {
		public function beforeFilter() {
			defaultSettings();
		}
	}