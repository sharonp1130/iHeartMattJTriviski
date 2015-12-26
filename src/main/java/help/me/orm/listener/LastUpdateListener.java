package help.me.orm.listener;

import javax.persistence.PrePersist;
import javax.persistence.PreUpdate;

import help.me.orm.entity.User;

public class LastUpdateListener {
    /**
     * automatic property set before any database persistence
     */
    @PreUpdate
    @PrePersist
    public void setLastUpdate(User u) {
    		System.out.println("WTF MAN:");
    }
}