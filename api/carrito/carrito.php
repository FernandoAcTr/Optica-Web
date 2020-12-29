<?php

session_start();
class Carrito
{
    public function __construct()
    {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = '';
        }
    }

    public function load()
    {
        return empty($_SESSION['carrito']) ? [] : json_decode($_SESSION['carrito'], true);
    }

    private function setItems($items)
    {
        $_SESSION['carrito'] = json_encode($items);
    }

    /**
     * Es necesario llevar un contador porque al recorrer con foreach el arreglo item se independiza del arreglo items
     * Entonces al modificar sus propiedades no se modifican las propiedades del objeto en el arreglo.
     * Se tiene que acceder directamente a la dimension $items[posicion][cantidad] y no a $item[cantidad].
     */
    public function add($id, $cantidad)
    {
        //Buscamos que el elemento no este en el carrito. Si esta solo aumentamos la cantidad
        $items = $this->load();
        $i = 0;
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                $items[$i]['cantidad'] += $cantidad;

                $this->setItems($items);

                return $this->load();
            }
            ++$i;
        }

        //Cuando el elemento sea nuevo
        $item = [
          'id' => (int) $id,
          'cantidad' => 1,
        ];
        $items[] = $item;
        $this->setItems($items);

        return $this->load();
    }

    public function remove($id)
    {
        $items = $this->load();
        $i = 0;
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                --$items[$i]['cantidad'];

                if ($items[$i]['cantidad'] == 0) {
                    unset($items[$i]);
                    $items = array_values($items); //reordenar los indices
                }
                $this->setItems($items);

                return $this->load();
            }
            ++$i;
        }

        return $this->load();
    }

    public function getNumberItems($id)
    {
        $items = $this->load();
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                return $item['cantidad'];
            }
        }

        return 0;
    }
}
