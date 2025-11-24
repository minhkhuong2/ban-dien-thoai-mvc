<?php
// File: app/Models/ProductModel.php

class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // =================================================================
    // PHẦN 1: CÁC HÀM DÀNH CHO ADMIN (QUẢN LÝ)
    // =================================================================

    // Lấy danh sách sản phẩm gốc
    public function getAllProducts()
    {
        $this->db->query(
            'SELECT p.*, b.name as brand_name 
             FROM products p
             JOIN brands b ON p.brand_id = b.id
             ORDER BY p.id DESC'
        );
        return $this->db->resultSet();
    }

    // Lấy thông tin 1 sản phẩm gốc
    public function getBaseProductById($id)
    {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Tạo sản phẩm gốc
    public function createBaseProduct($data)
    {
        $this->db->query(
            'INSERT INTO products (brand_id, category_id, name, description, screen_size, screen_tech, camera_rear, camera_front, cpu, chip, ram, ram_tech, battery, battery_tech, os, connectivity, weight, dimensions) 
             VALUES (:brand_id, :category_id, :name, :description, :screen_size, :screen_tech, :camera_rear, :camera_front, :cpu, :chip, :ram, :ram_tech, :battery, :battery_tech, :os, :connectivity, :weight, :dimensions)'
        );

        $this->db->bind(':brand_id', $data['brand_id']);
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':screen_size', $data['screen_size']);
        $this->db->bind(':screen_tech', $data['screen_tech']);
        $this->db->bind(':camera_rear', $data['camera_rear']);
        $this->db->bind(':camera_front', $data['camera_front']);
        $this->db->bind(':cpu', $data['cpu']);
        $this->db->bind(':chip', $data['chip']);
        $this->db->bind(':ram', $data['ram']);
        $this->db->bind(':ram_tech', $data['ram_tech']);
        $this->db->bind(':battery', $data['battery']);
        $this->db->bind(':battery_tech', $data['battery_tech']);
        $this->db->bind(':os', $data['os']);
        $this->db->bind(':connectivity', $data['connectivity']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':dimensions', $data['dimensions']);

        if ($this->db->execute()) {
            return $this->db->dbh->lastInsertId();
        } else {
            return false;
        }
    }

    // Cập nhật sản phẩm gốc
    public function updateBaseProduct($data)
    {
        $this->db->query(
            'UPDATE products SET 
             brand_id = :brand_id, category_id = :category_id, name = :name, description = :description, 
             screen_size = :screen_size, screen_tech = :screen_tech, camera_rear = :camera_rear, 
             camera_front = :camera_front, cpu = :cpu, chip = :chip, ram = :ram, 
             ram_tech = :ram_tech, battery = :battery, battery_tech = :battery_tech, 
             os = :os, connectivity = :connectivity, weight = :weight, dimensions = :dimensions
             WHERE id = :id'
        );

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':brand_id', $data['brand_id']);
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':screen_size', $data['screen_size']);
        $this->db->bind(':screen_tech', $data['screen_tech']);
        $this->db->bind(':camera_rear', $data['camera_rear']);
        $this->db->bind(':camera_front', $data['camera_front']);
        $this->db->bind(':cpu', $data['cpu']);
        $this->db->bind(':chip', $data['chip']);
        $this->db->bind(':ram', $data['ram']);
        $this->db->bind(':ram_tech', $data['ram_tech']);
        $this->db->bind(':battery', $data['battery']);
        $this->db->bind(':battery_tech', $data['battery_tech']);
        $this->db->bind(':os', $data['os']);
        $this->db->bind(':connectivity', $data['connectivity']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':dimensions', $data['dimensions']);

        return $this->db->execute();
    }

    // Xóa sản phẩm gốc
    public function deleteProduct($id)
    {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Lấy tất cả biến thể của 1 sản phẩm
    public function getVariantsByProductId($product_id)
    {
        $this->db->query('SELECT * FROM product_variants WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        return $this->db->resultSet();
    }

    // Thêm biến thể
    public function addVariant($data)
    {
        $this->db->query(
            'INSERT INTO product_variants (product_id, name, color, storage, price, price_sale, stock_quantity, image) 
             VALUES (:product_id, :name, :color, :storage, :price, :price_sale, :stock_quantity, :image)'
        );

        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':storage', $data['storage']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':price_sale', $data['price_sale'] ?: null);
        $this->db->bind(':stock_quantity', $data['stock_quantity']);
        $this->db->bind(':image', $data['image']);

        return $this->db->execute();
    }

    // Lấy 1 biến thể (để sửa)
    public function getVariantById($variant_id)
    {
        // Sửa lại câu query này để dùng cho cả Admin (chỉ lấy variant) và User (cần join product)
        // Ở đây ta ưu tiên lấy đủ thông tin cho User (Giỏ hàng/Checkout)
        $this->db->query(
            'SELECT v.*, p.name as product_name, p.brand_id, p.category_id 
             FROM product_variants v 
             JOIN products p ON v.product_id = p.id
             WHERE v.id = :id'
        );
        $this->db->bind(':id', $variant_id);
        return $this->db->single();
    }

    // Cập nhật biến thể
    public function updateVariant($data)
    {
        $this->db->query(
            'UPDATE product_variants SET 
             name = :name, color = :color, storage = :storage, 
             price = :price, price_sale = :price_sale, stock_quantity = :stock_quantity, 
             image = :image
             WHERE id = :id'
        );

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':storage', $data['storage']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':price_sale', $data['price_sale'] ?: null);
        $this->db->bind(':stock_quantity', $data['stock_quantity']);
        $this->db->bind(':image', $data['image']);

        return $this->db->execute();
    }

    // Xóa biến thể
    public function deleteVariant($id)
    {
        $this->db->query('DELETE FROM product_variants WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }


    // =================================================================
    // PHẦN 2: CÁC HÀM DÀNH CHO NGƯỜI DÙNG (WEBSITE)
    // =================================================================

    // Lấy tất cả biến thể để hiển thị (Trang chủ)
    public function getAllProductsForDisplay($limit = 8)
    {
        // Chúng ta sẽ GROUP BY p.id để mỗi điện thoại chỉ hiện 1 lần
        // Lấy giá thấp nhất (MIN price) để hiển thị "Giá từ..."
        $this->db->query(
            'SELECT 
            p.id as product_id, 
            p.name as product_name, 
            p.ram, 
            p.cpu, 
            p.brand_id,
            MIN(v.price) as min_price,
            MAX(v.price) as max_price,
            MAX(v.price_sale) as max_sale, -- Lấy giá sale nếu có
            (SELECT image FROM product_variants WHERE product_id = p.id LIMIT 1) as image -- Lấy ảnh của biến thể đầu tiên
        FROM products p
        JOIN product_variants v ON p.id = v.product_id
        WHERE v.stock_quantity > 0
        GROUP BY p.id
        ORDER BY p.id DESC
        LIMIT :limit'
        );

        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    // Lấy chi tiết 1 sản phẩm gốc (Trang chi tiết)
    public function getProductDetail($product_id)
    {
        $this->db->query('SELECT p.*, b.name as brand_name 
                         FROM products p 
                         JOIN brands b ON p.brand_id = b.id
                         WHERE p.id = :id');
        $this->db->bind(':id', $product_id);
        return $this->db->single();
    }

    // Lấy sản phẩm liên quan
    public function getRelatedProducts($category_id, $current_product_id)
    {
        // 1. Thử lấy sản phẩm cùng danh mục trước
        $sql = 'SELECT 
                v.id as variant_id, v.price, v.price_sale, v.image,
                p.id as product_id, p.name as product_name,
                MIN(v.price) as min_price,      -- Lấy giá thấp nhất
                MAX(v.price) as max_price,
                MAX(v.price_sale) as max_sale
             FROM product_variants v
             JOIN products p ON v.product_id = p.id
             WHERE p.category_id = :category_id 
             AND p.id != :current_product_id 
             GROUP BY p.id
             LIMIT 4';

        $this->db->query($sql);
        $this->db->bind(':category_id', $category_id);
        $this->db->bind(':current_product_id', $current_product_id);

        $result = $this->db->resultSet();

        // 2. [QUAN TRỌNG] Nếu không có sản phẩm cùng loại (kết quả rỗng)
        // -> Lấy đại 4 sản phẩm bất kỳ khác (Random) để lấp đầy giao diện
        if (empty($result)) {
            $sql_random = 'SELECT 
                        v.id as variant_id, v.price, v.price_sale, v.image,
                        p.id as product_id, p.name as product_name,
                        MIN(v.price) as min_price,
                        MAX(v.price) as max_price,
                        MAX(v.price_sale) as max_sale
                     FROM product_variants v
                     JOIN products p ON v.product_id = p.id
                     WHERE p.id != :current_product_id 
                     GROUP BY p.id
                     ORDER BY RAND() -- Lấy ngẫu nhiên
                     LIMIT 4';

            $this->db->query($sql_random);
            $this->db->bind(':current_product_id', $current_product_id);
            $result = $this->db->resultSet();
        }

        return $result;
    }

    // HÀM LỌC SẢN PHẨM (CẬP NHẬT THÊM DANH MỤC)
    public function getFilteredProducts($filters = [])
    {
        // Câu truy vấn cơ bản: Gom nhóm theo p.id để không bị lặp lại tên máy
        $sql = 'SELECT 
                p.id as product_id, 
                p.name as product_name, 
                p.ram, 
                p.cpu, 
                p.brand_id,
                MIN(v.price) as min_price,      -- Giá thấp nhất
                MAX(v.price) as max_price,      -- Giá cao nhất
                MAX(v.price_sale) as max_sale,  -- Kiểm tra xem có biến thể nào đang sale không
                (SELECT image FROM product_variants WHERE product_id = p.id LIMIT 1) as image -- Lấy 1 ảnh đại diện
            FROM products p
            JOIN product_variants v ON p.id = v.product_id
            WHERE v.stock_quantity > 0';

        // 1. Lọc theo Thương hiệu
        if (!empty($filters['brand_id'])) {
            $sql .= ' AND p.brand_id = :brand_id';
        }

        // 2. Lọc theo Danh mục
        if (!empty($filters['category_id'])) {
            $sql .= ' AND p.category_id = :category_id';
        }

        // 3. Lọc theo Tìm kiếm (Tên sản phẩm)
        if (!empty($filters['search_query'])) {
            $sql .= ' AND p.name LIKE :search_query';
        }

        // 4. Lọc theo Mức giá (Dựa trên giá thấp nhất min_price)
        // Lưu ý: Vì GROUP BY nên ta dùng HAVING cho các điều kiện tổng hợp (MIN/MAX)
        // Tuy nhiên để đơn giản và tối ưu, ta lọc WHERE trên từng biến thể trước, 
        // nhưng logic đúng nhất cho UX là lọc sau khi gom nhóm. 
        // Ở đây tôi dùng cách lọc biến thể con trước để đơn giản câu SQL.
        if (!empty($filters['price_range'])) {
            switch ($filters['price_range']) {
                case 1: // Dưới 5 triệu
                    $sql .= ' AND v.price < 5000000';
                    break;
                case 2: // 5 - 10 triệu
                    $sql .= ' AND v.price BETWEEN 5000000 AND 10000000';
                    break;
                case 3: // 10 - 20 triệu
                    $sql .= ' AND v.price BETWEEN 10000000 AND 20000000';
                    break;
                case 4: // 20 - 30 triệu
                    $sql .= ' AND v.price BETWEEN 20000000 AND 30000000';
                    break;
                case 5: // Trên 30 triệu
                    $sql .= ' AND v.price > 30000000';
                    break;
            }
        }

        // QUAN TRỌNG: Gom nhóm
        $sql .= ' GROUP BY p.id';

        // 5. Sắp xếp
        if (!empty($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case 'price_asc':
                    $sql .= ' ORDER BY MIN(v.price) ASC';
                    break;
                case 'price_desc':
                    $sql .= ' ORDER BY MIN(v.price) DESC';
                    break;
                case 'newest':
                    $sql .= ' ORDER BY p.id DESC';
                    break;
                default:
                    $sql .= ' ORDER BY p.id DESC';
            }
        } else {
            $sql .= ' ORDER BY p.id DESC';
        }

        $this->db->query($sql);

        // Bind giá trị
        if (!empty($filters['brand_id'])) {
            $this->db->bind(':brand_id', $filters['brand_id']);
        }
        if (!empty($filters['category_id'])) {
            $this->db->bind(':category_id', $filters['category_id']);
        }
        if (!empty($filters['search_query'])) {
            $this->db->bind(':search_query', '%' . $filters['search_query'] . '%');
        }

        return $this->db->resultSet();
    }

    // Tìm kiếm (Gọi lại hàm lọc)
    public function searchProducts($query)
    {
        return $this->getFilteredProducts(['search_query' => $query]);
    }

    // Lấy sản phẩm đang giảm giá (Trang Khuyến mãi)
    public function getOnSaleVariants()
    {
        $this->db->query(
            'SELECT 
                v.id as variant_id, v.price, v.price_sale, v.storage, v.color, v.image,
                p.id as product_id, p.name as product_name, p.ram, p.cpu, p.brand_id
            FROM product_variants v
            JOIN products p ON v.product_id = p.id
            WHERE v.stock_quantity > 0 AND v.price_sale IS NOT NULL AND v.price_sale > 0
            ORDER BY v.id DESC'
        );
        return $this->db->resultSet();
    }

    // Thống kê Dashboard
    public function countVariants()
    {
        $this->db->query('SELECT COUNT(*) as count FROM product_variants');
        $row = $this->db->single();
        return $row['count'];
    }

    // =================================================================
    // PHẦN 3: ĐÁNH GIÁ (REVIEWS)
    // =================================================================

    public function getReviewsByProductId($product_id)
    {
        $this->db->query('SELECT * FROM product_reviews WHERE product_id = :product_id ORDER BY created_at DESC');
        $this->db->bind(':product_id', $product_id);
        return $this->db->resultSet();
    }

    public function getRatingInfo($product_id)
    {
        $this->db->query('SELECT COUNT(id) as review_count, AVG(rating) as avg_rating FROM product_reviews WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        $row = $this->db->single();
        if ($row['avg_rating'] === null) $row['avg_rating'] = 0;
        return $row;
    }
    // =================================================================
    // PHẦN 4: QUẢN LÝ THƯ VIỆN ẢNH (GALLERY)
    // =================================================================

    // Lấy tất cả ảnh phụ của sản phẩm
    public function getGalleryByProductId($product_id)
    {
        $this->db->query('SELECT * FROM product_gallery WHERE product_id = :product_id');
        $this->db->bind(':product_id', $product_id);
        return $this->db->resultSet();
    }

    // Thêm ảnh vào gallery
    public function addGalleryImage($product_id, $image, $color = null)
    {
        $this->db->query('INSERT INTO product_gallery (product_id, image, color) VALUES (:product_id, :image, :color)');
        $this->db->bind(':product_id', $product_id);
        $this->db->bind(':image', $image);
        $this->db->bind(':color', $color); // Có thể null
        return $this->db->execute();
    }

    // Xóa ảnh khỏi gallery
    public function deleteGalleryImage($id)
    {
        // Lấy tên ảnh để xóa file vật lý (nếu cần xử lý ở controller)
        $this->db->query('SELECT image FROM product_gallery WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        if ($row) {
            $this->db->query('DELETE FROM product_gallery WHERE id = :id');
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                return $row['image']; // Trả về tên ảnh để Controller xóa file
            }
        }
        return false;
    }
}
