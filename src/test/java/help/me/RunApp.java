package help.me;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.dao.IServiceDao;
import help.me.orm.entity.Service;


public class RunApp {
	
	
	
	public static void main(String[] args) {
	    	ApplicationContext appContext = 
	    	    	  new ClassPathXmlApplicationContext("config/BeanLocations.xml");
	    		
	    	Bunk b =  (Bunk)appContext.getBean("bunk");
	    	b.balls();
//    	    	IServiceDao stockBo = (IServiceDao)appContext.getBean("serviceDao");
	    	    	
	    	    	
    	    	
	}
	

}
    	    	/** insert **/
//    	    	Stock stock = new Stock();
//    	    	stock.setStockCode("7668");
//    	    	stock.setStockName("HAIO");
//    	    	stockBo.save(stock);
//    	    	
//    	    	/** select **/
//    	    	Stock stock2 = stockBo.findByStockCode("7668");
//    	    	System.out.println(stock2);
//    	    	
//    	    	/** update **/
//    	    	stock2.setStockName("HAIO-1");
//    	    	stockBo.update(stock2);
//    	    	
//    	    	/** delete **/
//    	    	stockBo.delete(stock2);
//    	    	
//    	    	System.out.println("Done");
//    	    }
//
//	}
//
//}
