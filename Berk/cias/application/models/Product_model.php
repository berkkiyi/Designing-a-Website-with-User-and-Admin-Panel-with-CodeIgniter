<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
    /**
     * This function is used to get the product listing count
     * @param string $searchText : This is optional search text
     * @return int $count : This is the row count
     */
    function productListingCount($searchText)
    {
        $this->db->select('BaseTbl.productId, BaseTbl.productName, BaseTbl.createdDtm');
        $this->db->from('tbl_product as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.productName LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the product listing
     * @param string $searchText : This is optional search text
     * @param int $page : This is pagination offset
     * @param int $segment : This is pagination limit
     * @return array $result : This is the result array
     */
    public function productListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.productId, BaseTbl.productName, BaseTbl.productPhoto, BaseTbl.createdDtm, BaseTbl.description, BaseTbl.productPrice');
        $this->db->from('tbl_product as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.productName LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.productId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    /**
     * This function is used to add a new product to the system
     * @param array $productInfo : This is the product information to be added
     * @return int $insert_id : This is the last inserted id
     */
    function addNewProduct($productInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_product', $productInfo);

        $insert_id = $this->db->insert_id();

        // Ürün fotoğrafını kaydetmek için
        if (isset($productInfo['productPhoto'])) {
            $productPhoto = $productInfo['productPhoto'];
            $this->db->set('productPhoto', $productPhoto);
            $this->db->where('productId', $insert_id);
            $this->db->update('tbl_product');
        }

        $this->db->trans_complete();

        return $insert_id;
    }



    /**
     * This function is used to get product information by id
     * @param int $productId : This is the product id
     * @return object $result : This is the product information
     */
    function getProductInfo($productId)
    {
        $this->db->select('productId, productName, productPrice,  productPhoto, description');
        $this->db->from('tbl_product');
        $this->db->where('productId', $productId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the product information
     * @param array $productInfo : This is the updated product information
     * @param int $productId : This is the product id
     * @return bool : This indicates the success of the update operation
     */
    function editProduct($productInfo, $productId)
    {
        $this->db->where('productId', $productId);
        $this->db->update('tbl_product', $productInfo);

        return $this->db->affected_rows() > 0; // Değişiklik: TRUE -> $this->db->affected_rows() > 0
    }



    /**
     * This function is used to delete a product from the database
     * @param int $productId : Product ID to be deleted
     * @return bool : Returns TRUE on successful deletion, otherwise FALSE
     */
    public function deleteProduct($productId)
    {
        $this->db->where('productId', $productId);
        $this->db->delete('tbl_product');

        return $this->db->affected_rows() > 0;
    }
}
