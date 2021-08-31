<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.author.com
 * @since      1.0.0
 *
 * @package    Extension
 * @subpackage Extension/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Extension
 * @subpackage Extension/admin
 * @author     pushkarUpadhyay <pushkar@gmail.com>
 */
class Extension_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extension_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extension_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/extension-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extension_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extension_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/extension-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name,'localize', array("ajaxurl"=>admin_url('admin-ajax.php')) );

	}

	



	function create_product_metabox(){
		$scr = ['post','product'];
    	foreach($scr as $scr){
    	add_meta_box('product-id','Product Data',array($this,'product_data_function'),$scr,'normal','high');
    	}
	}
	public function tags_autofill_function($post_id) {

		update_post_meta(
			$post_id,
			'product_price',
			$_POST['product_price']
		);
		update_post_meta($post_id,'product_sku',$_POST['product_sku']);
		update_post_meta($post_id, 'product_stock',$_POST['product_stock']);
		
		$arr= array();
		array_push($arr,$p);
		array_push($arr,$s);
		array_push($arr,$ss);
		
		$back = json_encode($arr);
		print_r($back);
		
	}

	function product_data_function(){
		$path = plugin_dir_url( __FILE__ ) . 'js/extension-admin.js';
		?>   
		<div>
			<div>
				<input type="text" name="txtPublisherName"  placeholder="Simple Product">
				<input type="checkbox" name="check" id="radio1">
				<label for="check">Downloadable</label>
				<input type="checkbox" name="check2" id="radio2">
				<label for="check2">Virtual</label>
			</div>
			<hr>
			<div>
				<label for="product_price">Required Price</label>
				<input type="text" name="product_price" id="price" value="<?php if(isset($_POST['product_price'])){echo $_POST['product_price'];} ?>">
				<label for="product_sku">SKU</label>
				<input type="number" name="product_sku" id="sku" value="<?php if(isset($_POST['product_sku'])){ echo $_POST['product_sku'];}?>">
				<label for="product_stock" >Stock</label>
				<input type="text" name="product_stock" id="stock" value="<?php if(isset($_POST['product_stock'])){ echo $_POST['product_stock'];}?>">
				<button id="button">Save</button>

			</div>
			<!-- <?php
			// if(isset($_POST['product_price'])&& isset($_POST['product_sku']) && isset($_POST['product_stock'])){
			// 	$publisher = get_post_meta(get_the_ID(),'product_price',true);
			// 	$pub = get_post_meta(get_the_ID(),'product_sku',true);
			// 	$stock = get_post_meta(get_the_ID(),'product_stock',true);
			// }
			
			?> -->
			<script src="<?php echo $path;?>"></script>
		</div>

    <?php
	}

	function save_metabox_data($post_id){
		if ( array_key_exists( 'product_price', $_POST )&& array_key_exists('product_sku',$_POST) && array_key_exists('product_stock',$_POST) ) {
			update_post_meta(
				$post_id,
				'product_price',
				$_POST['product_price']
			);
			update_post_meta($post_id,'product_sku',$_POST['product_sku']);
			update_post_meta($post_id, 'product_stock',$_POST['product_stock']);
		}
	
	}

	







}
