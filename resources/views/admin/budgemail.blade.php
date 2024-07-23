<!DOCTYPE html>
<html>
<head>
<title>Cotizador</title>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}   
#tabla {
  width: 900px;
  margin: 0 auto;
}
.logo-bg {
            position: absolute ;
            top: 40% ;
            left: -200px ;
            z-index: -10000;
            opacity: 0.5 ;
        }
</style>

</head>
<body>

<?php 
    use Illuminate\Support\Facades\DB;
    $customer=$data['customer'];
    $budget_histories=$data['budget_histories'];
    $footers=$data['footers'];
    $pavers=$data['pavers'];
    $concrete=$data['concrete'];
    $solid_roof=$data['solid_roof'];
    $aluminum=$data['aluminum'];
    $aluminum2=$data['aluminum2'];
    $history=$data['history'];
    //--
    $extra=$data['extra'];
    $permit=$data['permit'];
    $estimate=$data['estimate'];
?>
    <div style="text-align:center;">
        <!-- -->
        <img  src="https://estimate.induzone.net/imgs/logo_induzone_red.png" class="logo-bg">
        <!-- -->
        <h3>
        Customer Information
        <h3>    
        <p>
            Name :{{ @$customer[0]->name }} ,
            Last name : {{ @$customer[0]->last_name }} ,
            Phone number : {{ @$customer[0]->phone_number }} ,<br>
            Code zip : {{ @$customer[0]->code_zip }},
            Email : {{ @$customer[0]->email }} .
        </p>
        <!-- -->
        <h3>
        Budgeted Table
        <h3>
        <?php 
        if ($footers->count() >0  )
        {
            $pos1 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','footers')
            ->where('history',$history)
            ->where('postition',1)
            ->get();
            //
            $pos2 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','footers')
            ->where('history',$history)
            ->where('postition',2)
            ->get();
            //
            $pos3 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','footers')
            ->where('history',$history)
            ->where('postition',3)
            ->get();
            $pos4 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','footers')
            ->where('history',$history)
            ->where('postition',4)
            ->get();
            $pos5=   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','footers')
            ->where('history',$history)
            ->where('postition',5)
            ->get();
            if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
            {
                $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
            }   
            else
                $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
            //
            if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
            {
                $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
            }   
            else
                $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
            {
                $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
            }   
            else
                $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
            {
                $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
            }   
            else
                $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
            if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                {
                    $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                }   
                else
                    $colum5 ='&nbsp; &nbsp; &nbsp;  ';  
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">FOOTERS</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
        <?php 
        if ($pavers->count() >0  )
        {
            $pos1 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','pavers')
            ->where('history',$history)
            ->where('postition',1)
            ->get();
            //
            $pos2 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','pavers')
            ->where('history',$history)
            ->where('postition',2)
            ->get();
            //
            $pos3 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','pavers')
            ->where('history',$history)
            ->where('postition',3)
            ->get();
            $pos4 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','pavers')
            ->where('history',$history)
            ->where('postition',4)
            ->get();
            $pos5=   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','pavers')
            ->where('history',$history)
            ->where('postition',5)
            ->get();
            if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
            {
                $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
            }   
            else
                $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
            //
            if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
            {
                $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
            }   
            else
                $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
            {
                $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
            }   
            else
                $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
            {
                $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
            }   
            else
                $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
            if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                {
                    $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                }   
                else
                    $colum5 ='&nbsp; &nbsp; &nbsp;  ';   
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">PAVERS</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
        <?php 
        if ($concrete->count() >0  )
        {
            $pos1 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','concrete')
            ->where('history',$history)
            ->where('postition',1)
            ->get();
            //
            $pos2 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','concrete')
            ->where('history',$history)
            ->where('postition',2)
            ->get();
            //
            $pos3 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','concrete')
            ->where('history',$history)
            ->where('postition',3)
            ->get();
            $pos4 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','concrete')
            ->where('history',$history)
            ->where('postition',4)
            ->get();
            $pos5=   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','concrete')
            ->where('history',$history)
            ->where('postition',5)
            ->get();
            if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
            {
                $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
            }   
            else
                $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
            //
            if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
            {
                $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
            }   
            else
                $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
            {
                $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
            }   
            else
                $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
            {
                $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
            }   
            else
                $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
            if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                {
                    $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                }   
                else
                    $colum5 ='&nbsp; &nbsp; &nbsp;  ';    
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">CONCRETE</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
        <?php 
        if ($solid_roof->count() >0  )
        {
             $pos1 =   DB::table('budgets')
             ->where('customer_id',$customer[0]->id)
             ->where('type','solid_roof')
             ->where('history',$history)
             ->where('postition',1)
             ->get();
             //
             $pos2 =   DB::table('budgets')
             ->where('customer_id',$customer[0]->id)
             ->where('type','solid_roof')
             ->where('history',$history)
             ->where('postition',2)
             ->get();
             //
             $pos3 =   DB::table('budgets')
             ->where('customer_id',$customer[0]->id)
             ->where('type','solid_roof')
             ->where('history',$history)
             ->where('postition',3)
             ->get();
             $pos4 =   DB::table('budgets')
             ->where('customer_id',$customer[0]->id)
             ->where('type','solid_roof')
             ->where('history',$history)
             ->where('postition',4)
             ->get();
             $pos5=   DB::table('budgets')
             ->where('customer_id',$customer[0]->id)
             ->where('type','solid_roof')
             ->where('history',$history)
             ->where('postition',5)
             ->get();
             if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
             {
                 $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
             }   
             else
                 $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
             //
             if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
             {
                 $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
             }   
             else
                 $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
             //
             if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
             {
                 $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
             }   
             else
                 $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
             //
             if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
             {
                 $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
             }   
             else
                 $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
             if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                 {
                     $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                 }   
                 else
                     $colum5 ='&nbsp; &nbsp; &nbsp;  ';   
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">SOLID ROOF</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
        <?php 
        if ($aluminum->count() >0  )
        {
            $pos1 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum')
            ->where('history',$history)
            ->where('postition',1)
            ->get();
            //
            $pos2 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum')
            ->where('history',$history)
            ->where('postition',2)
            ->get();
            //
            $pos3 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum')
            ->where('history',$history)
            ->where('postition',3)
            ->get();
            $pos4 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum')
            ->where('history',$history)
            ->where('postition',4)
            ->get();
            $pos5=   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum')
            ->where('history',$history)
            ->where('postition',5)
            ->get();
            if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
            {
                $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
            }   
            else
                $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
            //
            if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
            {
                $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
            }   
            else
                $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
            {
                $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
            }   
            else
                $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
            {
                $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
            }   
            else
                $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
            if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                {
                    $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                }   
                else
                    $colum5 ='&nbsp; &nbsp; &nbsp;  '; 
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">ALUMINUM</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
        <?php 
        if ($aluminum2->count() >0  )
        {
            $pos1 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum2')
            ->where('history',$history)
            ->where('postition',1)
            ->get();
            //
            $pos2 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum2')
            ->where('history',$history)
            ->where('postition',2)
            ->get();
            //
            $pos3 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum2')
            ->where('history',$history)
            ->where('postition',3)
            ->get();
            $pos4 =   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum2')
            ->where('history',$history)
            ->where('postition',4)
            ->get();
            $pos5=   DB::table('budgets')
            ->where('customer_id',$customer[0]->id)
            ->where('type','aluminum2')
            ->where('history',$history)
            ->where('postition',5)
            ->get();
            if (( floatval($pos1[0]->base) >0  ) && floatval($pos1[0]->mul) && floatval($pos1[0]->val))
            {
                $colum1 =$pos1[0]->base .' * '.$pos1[0]->mul.' = '.$pos1[0]->val;
            }   
            else
                $colum1 ='&nbsp; &nbsp; &nbsp;  ';   
            //
            if (( floatval($pos2[0]->base) >0  ) && floatval($pos2[0]->mul) && floatval($pos2[0]->val))
            {
                $colum2 =$pos2[0]->base .' * '.$pos2[0]->mul.' = '.$pos2[0]->val;
            }   
            else
                $colum2 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos3[0]->base) >0  ) && floatval($pos3[0]->mul) && floatval($pos3[0]->val))
            {
                $colum3 =$pos3[0]->base .' * '.$pos3[0]->mul.' = '.$pos3[0]->val;
            }   
            else
                $colum3 ='&nbsp; &nbsp; &nbsp;  ';  
            //
            if (( floatval($pos4[0]->base) >0  ) && floatval($pos4[0]->mul) && floatval($pos4[0]->val))
            {
                $colum4 =$pos4[0]->base .' * '.$pos4[0]->mul.' = '.$pos4[0]->val;
            }   
            else
                $colum4 ='&nbsp; &nbsp; &nbsp;  ';  
            if (( floatval($pos5[0]->base) >0  ) && floatval($pos5[0]->mul) && floatval($pos5[0]->val))
                {
                    $colum5 =$pos5[0]->base .' * '.$pos5[0]->mul.' = '.$pos5[0]->val;
                }   
                else
                    $colum5 ='&nbsp; &nbsp; &nbsp;  ';  
            ?>
                <table  id ="table">
                    <tr>
                        <th colspan="4">ALUMINUM</th>
                        <th rowspan ="5"><?= $colum5 ?></th>
                    </tr>
                    <tr>
                        <td><?= $colum1 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum2 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum3 ?></td>
                    </tr>
                    <tr>
                        <td><?= $colum4 ?></td>
                    </tr>
                </table>
                <hr>
            <?php 
        }
        ?>
        <!-- --> 
    </div>
   
</body>
</html>


