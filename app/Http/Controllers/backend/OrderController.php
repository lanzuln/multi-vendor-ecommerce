<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller {
    public function PendingOrder() {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.pages.order.pending', compact('orders'));
    } // End Method
    public function AdminOrderDetails($order_id) {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.pages.order.admin_order_details', compact('order', 'orderItem'));

    } // End Method

    public function AdminConfirmedOrder() {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        return view('backend.pages.order.confirmed_orders', compact('orders'));
    } // End Method

    public function AdminProcessingOrder() {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('backend.pages.order.processing_orders', compact('orders'));
    } // End Method

    public function AdminDeliveredOrder() {
        $orders = Order::where('status', 'deliverd')->orderBy('id', 'DESC')->get();
        return view('backend.pages.order.delivered_orders', compact('orders'));
    } // End Method
    public function PendingToConfirm($order_id) {
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        toastr()->success('Order Confirm Successfully');

        return redirect()->route('admin.confirmed.order');

    } // End Method

    public function ConfirmToProcess($order_id) {
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        toastr()->success('Order Processing Successfully');

        return redirect()->route('admin.processing.order');

    } // End Method

    public function ProcessToDelivered($order_id) {

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        }

        Order::findOrFail($order_id)->update(['status' => 'deliverd']);


        toastr()->success('Order Deliverd Successfully');

        return redirect()->route('admin.delivered.order');

    } // End Method
    public function AdminInvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.pages.order.admin_order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method


}
