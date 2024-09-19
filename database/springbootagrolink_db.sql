ALTER TABLE tblbuyer AUTO_INCREMENT = 101;

ALTER TABLE tblfarmer AUTO_INCREMENT = 1001;

package com.agrolink.controller;

import com.agrolink.entity.Registerbuyer;
import com.agrolink.service.BuyerService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/buyer-register")
public class BuyerController {

    @Autowired
    private BuyerService buyerService;

    @PostMapping
    public Registerbuyer registerBuyer(@RequestBody Registerbuyer registerbuyer) {
        return buyerService.saveBuyer(registerbuyer);
    }
}
