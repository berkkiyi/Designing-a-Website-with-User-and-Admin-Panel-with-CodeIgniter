<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Product extends BaseController
{
    /**
     * This is the default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Product';
    }

    /**
     * This is the default routing method
     * It routes to the default listing page
     */
    public function index()
    {
        redirect('product/productListing');
    }

    /**
     * This function is used to load the product list
     */
    public function productListing()
    {

        $searchText = '';
        if (!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->pm->productListingCount($searchText);

        $returns = $this->paginationCompress("product/productListing/", $count, 10);

        $data['records'] = $this->pm->productListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'CodeInsect : Product';

        $this->loadViews("product/productListing", $this->global, $data, NULL);
    }


    /**
     * This function is used to load the add new form
     */
    public function add()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'CodeInsect : Add New Product';

            $this->loadViews("product/add", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add a new product to the system
     */
    public function addNewProduct()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->load->helper('security');

            $this->form_validation->set_rules('productName', 'Product Name', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $productName = $this->security->xss_clean($this->input->post('productName'));
                $productPrice = $this->security->xss_clean($this->input->post('productPrice'));
                $description = $this->security->xss_clean($this->input->post('description'));

                // Fotoğrafı yüklemek için gerekli işlemleri yapın ve $productPhotoPath değişkenine dosya yolunu atayın
                if ($_FILES['productPhoto']['name']) {
                    $config['upload_path'] = 'uploads/products/'; // Fotoğrafın yükleneceği dizin
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Desteklenen dosya türleri
                    $config['file_name'] = uniqid() . '_' . $_FILES['productPhoto']['name']; // Yeni dosya adı

                    $this->load->library('upload', $config);


                    if ($this->upload->do_upload('productPhoto')) {
                        $uploadData = $this->upload->data();
                        $productPhotoPath = $config['upload_path'] . $uploadData['file_name'];
                    } else {
                        // Dosya yükleme hatası oluştu
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('product/add');
                    }
                }

                $productInfo = array(
                    'productName' => $productName,
                    'productPrice' => $productPrice,
                    'description' => $description,
                    'productPhoto' => isset($productPhotoPath) ? $productPhotoPath  : null,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:s')
                );


                $result = $this->pm->addNewProduct($productInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Product created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Product creation failed');
                }

                redirect('product/productListing');
            }
        }
    }


    /**
     * This function is used to load product edit information
     * @param number $productId : Optional : This is the product ID
     */
    public function edit($productId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($productId == null) {
                redirect('product/productListing');
            }

            $data['product'] = $this->pm->getProductInfo($productId); // Değişiklik: $productInfo -> $product

            $this->global['pageTitle'] = 'CodeInsect : Edit Product';

            $this->loadViews("product/edit", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit product information
     */
    public function editProduct()
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $productId = $this->input->post('productId');

            $this->form_validation->set_rules('productName', 'Product Name', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[1024]');
            $this->form_validation->set_rules('productPrice', 'Product Price', 'trim|required|max_length[10]'); // Ürün fiyatı için kural eklendi

            if ($this->form_validation->run() == FALSE) {
                $this->edit($productId);
            } else {
                $productName = $this->security->xss_clean($this->input->post('productName'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $productPrice = $this->security->xss_clean($this->input->post('productPrice')); // Ürün fiyatı alındı

                $productInfo = array(
                    'productName' => $productName,
                    'description' => $description,
                    'productPrice' => $productPrice, // Ürün fiyatı da güncelleniyor
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->pm->editProduct($productInfo, $productId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Product updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Product updation failed');
                }

                redirect('product/productListing');
            }
        }
    }

    /**
     * This function is used to delete a product
     * @param int $productId : Product ID to be deleted
     */
    public function delete($productId)
    {
        if (!$this->hasDeleteAccess()) {
            $this->loadThis();
        } else {
            $product = $this->pm->getProductInfo($productId); // Ürün bilgilerini al

            if ($product) {
                // Ürün fotoğrafını silmek için gerekli işlemleri yapın
                if (!empty($product->productPhoto)) {
                    unlink($product->productPhoto); // Dosyayı silmek için unlink() fonksiyonunu kullanıyoruz
                }

                $delete = $this->pm->deleteProduct($productId); // Ürünü sil

                if ($delete) {
                    $this->session->set_flashdata('success', 'Product deleted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Product deletion failed');
                }
            } else {
                $this->session->set_flashdata('error', 'Product not found');
            }

            redirect('product/productListing');
        }
    }
}
